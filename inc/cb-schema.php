<?php
/**
 * Structured data (schema.org) customisations.
 *
 * FAQ schema is collected while the CB FAQ block renders and output as JSON-LD in
 * the footer (robust to however the block is embedded). Author E-E-A-T extends
 * Yoast SEO's Person node via its graph filter, so there is no duplicate/conflicting
 * author schema.
 *
 * @package cb-peoplesafe
 */

defined('ABSPATH') || exit;

/* -------------------------------------------------------------------------
 * FAQ schema (JSON-LD, built from the CB FAQ block as it renders)
 * ---------------------------------------------------------------------- */

/**
 * Record one FAQ question/answer pair as the CB FAQ block renders it.
 * Called from page-templates/blocks/cb_faq_block.php.
 *
 * @param string $question
 * @param string $answer
 * @return void
 */
function cb_register_faq_item($question, $answer)
{
    if (is_admin()) {
        return; // ignore editor previews
    }
    $question = trim(wp_strip_all_tags((string) $question));
    $answer   = cb_faq_answer_html((string) $answer);
    if ($question === '' || $answer === '') {
        return;
    }
    if (!isset($GLOBALS['cb_faq_schema_items'])) {
        $GLOBALS['cb_faq_schema_items'] = array();
    }
    $GLOBALS['cb_faq_schema_items'][] = array(
        '@type'          => 'Question',
        'name'           => $question,
        'acceptedAnswer' => array(
            '@type' => 'Answer',
            'text'  => $answer,
        ),
    );
}

/**
 * Output a single FAQPage JSON-LD block in the footer for any singular page that
 * rendered one or more CB FAQ blocks.
 *
 * @return void
 */
add_action('wp_footer', 'cb_output_faq_schema', 20);
function cb_output_faq_schema()
{
    if (!is_singular() || empty($GLOBALS['cb_faq_schema_items'])) {
        return;
    }

    $data = array(
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        '@id'        => get_permalink() . '#faq',
        'mainEntity' => array_values($GLOBALS['cb_faq_schema_items']),
    );

    echo "\n" . '<script type="application/ld+json">'
        . wp_json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
        . '</script>' . "\n";
}

/**
 * Sanitise a FAQ answer to the limited HTML that Google permits in FAQ answers.
 *
 * @param string $raw Raw answer field value.
 * @return string
 */
function cb_faq_answer_html($raw)
{
    $allowed = array(
        'p'  => array(), 'br' => array(), 'b'  => array(), 'strong' => array(),
        'i'  => array(), 'em' => array(), 'ul' => array(), 'ol' => array(), 'li' => array(),
        'a'  => array('href' => array(), 'title' => array(), 'target' => array(), 'rel' => array()),
        'h1' => array(), 'h2' => array(), 'h3' => array(), 'h4' => array(), 'h5' => array(), 'h6' => array(),
    );

    $html = wp_kses(wpautop($raw), $allowed);

    return trim(preg_replace('/\s+/', ' ', $html));
}

/* -------------------------------------------------------------------------
 * Author E-E-A-T: extra profile fields + enriched Person schema
 * ---------------------------------------------------------------------- */

/**
 * Add "Job title" and "Areas of expertise" fields to the user profile screen.
 * WordPress has no native fields for these, and they power the author's
 * jobTitle / knowsAbout structured data. (Bio and social URLs already exist on
 * the profile and are handled by Yoast.)
 *
 * @param WP_User $user
 * @return void
 */
add_action('show_user_profile', 'cb_author_profile_fields');
add_action('edit_user_profile', 'cb_author_profile_fields');
function cb_author_profile_fields($user)
{
    ?>
    <h2>Author profile (structured data / E-E-A-T)</h2>
    <table class="form-table" role="presentation">
        <tr>
            <th><label for="cb_job_title">Job title</label></th>
            <td>
                <input type="text" name="cb_job_title" id="cb_job_title" class="regular-text"
                    value="<?php echo esc_attr(get_user_meta($user->ID, 'cb_job_title', true)); ?>" />
                <p class="description">e.g. "Content Marketing Manager". Output as the author's <code>jobTitle</code>.</p>
            </td>
        </tr>
        <tr>
            <th><label for="cb_expertise">Areas of expertise</label></th>
            <td>
                <input type="text" name="cb_expertise" id="cb_expertise" class="regular-text"
                    value="<?php echo esc_attr(get_user_meta($user->ID, 'cb_expertise', true)); ?>" />
                <p class="description">Comma-separated, e.g. "Lone worker safety, Personal safety technology". Output as <code>knowsAbout</code>.</p>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Save the custom author profile fields.
 *
 * @param int $user_id
 * @return void
 */
add_action('personal_options_update', 'cb_save_author_profile_fields');
add_action('edit_user_profile_update', 'cb_save_author_profile_fields');
function cb_save_author_profile_fields($user_id)
{
    if (!current_user_can('edit_user', $user_id)) {
        return;
    }
    if (isset($_POST['cb_job_title'])) {
        update_user_meta($user_id, 'cb_job_title', sanitize_text_field(wp_unslash($_POST['cb_job_title'])));
    }
    if (isset($_POST['cb_expertise'])) {
        update_user_meta($user_id, 'cb_expertise', sanitize_text_field(wp_unslash($_POST['cb_expertise'])));
    }
}

/**
 * Enrich the post author's Person node in Yoast's graph with jobTitle, knowsAbout
 * and description (bio). sameAs (LinkedIn etc.) is left to Yoast's own social fields.
 *
 * @param array $graph   Yoast schema graph pieces.
 * @param mixed $context Yoast meta tags context.
 * @return array
 */
add_filter('wpseo_schema_graph', 'cb_enrich_author_person_schema', 12, 2);
function cb_enrich_author_person_schema($graph, $context = null)
{
    if (!is_singular()) {
        return $graph;
    }

    $author_id = (int) get_post_field('post_author', get_queried_object_id());
    if (!$author_id) {
        return $graph;
    }

    $job_title     = trim((string) get_user_meta($author_id, 'cb_job_title', true));
    $expertise_raw = trim((string) get_user_meta($author_id, 'cb_expertise', true));
    $bio           = trim((string) get_the_author_meta('description', $author_id));

    if ($job_title === '' && $expertise_raw === '' && $bio === '') {
        return $graph; // nothing to add
    }

    $knows_about = array();
    foreach (explode(',', $expertise_raw) as $topic) {
        $topic = trim($topic);
        if ($topic !== '') {
            $knows_about[] = $topic;
        }
    }

    // Prefer matching the Person node referenced as the content's author.
    $author_ref = null;
    foreach ($graph as $node) {
        if (!empty($node['@type'])
            && cb_schema_type_matches($node['@type'], array('Article', 'BlogPosting', 'WebPage'))
            && !empty($node['author']['@id'])) {
            $author_ref = $node['author']['@id'];
            break;
        }
    }
    $author_name = get_the_author_meta('display_name', $author_id);

    foreach ($graph as &$node) {
        if (empty($node['@type']) || !cb_schema_type_matches($node['@type'], array('Person'))) {
            continue;
        }
        $is_author = ($author_ref && !empty($node['@id']) && $node['@id'] === $author_ref)
            || (!$author_ref && !empty($node['name']) && $node['name'] === $author_name);
        if (!$is_author) {
            continue;
        }

        if ($job_title !== '') {
            $node['jobTitle'] = $job_title;
        }
        if (!empty($knows_about)) {
            $node['knowsAbout'] = $knows_about;
        }
        if ($bio !== '' && empty($node['description'])) {
            $node['description'] = $bio;
        }
        break;
    }
    unset($node);

    return $graph;
}

/**
 * Whether a schema node @type (string or array) matches any of the wanted types.
 *
 * @param string|array $type
 * @param array        $wanted
 * @return bool
 */
function cb_schema_type_matches($type, array $wanted)
{
    $types = is_array($type) ? $type : array($type);
    return (bool) array_intersect($types, $wanted);
}
