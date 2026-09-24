<?php
/**
 * Structured data (schema.org) customisations.
 *
 * These EXTEND Yoast SEO's JSON-LD graph rather than printing separate JSON-LD
 * blocks, so the site keeps a single, non-conflicting schema graph.
 *
 * @package cb-peoplesafe
 */

defined('ABSPATH') || exit;

/**
 * Add a FAQPage node to Yoast's schema graph, built from the CB FAQ block's ACF data.
 *
 * The CB FAQ block previously carried the FAQ schema as inline microdata; that markup
 * has been removed from the block template, and the FAQ schema is now provided here as
 * JSON-LD inside Yoast's graph instead — the modern, preferred format that validators
 * and Google read. Applies to any singular page that uses the CB FAQ block.
 *
 * @param array $graph   Yoast schema graph pieces.
 * @param mixed $context Yoast meta tags context (has ->canonical).
 * @return array
 */
add_filter('wpseo_schema_graph', 'cb_add_faq_schema_to_yoast_graph', 11, 2);
function cb_add_faq_schema_to_yoast_graph($graph, $context = null)
{
    if (!is_singular() || !function_exists('acf_setup_meta')) {
        return $graph;
    }

    $post = get_post();
    if (!$post || strpos((string) $post->post_content, 'acf/cb_faq_block') === false) {
        return $graph;
    }

    $questions = array();
    cb_collect_faq_questions(parse_blocks($post->post_content), $questions);

    if (empty($questions)) {
        return $graph;
    }

    $canonical = (is_object($context) && !empty($context->canonical))
        ? $context->canonical
        : get_permalink($post);

    $graph[] = array(
        '@type'      => 'FAQPage',
        '@id'        => $canonical . '#faq',
        'mainEntity' => $questions,
    );

    return $graph;
}

/**
 * Recursively pull question/answer pairs from every CB FAQ block in a block tree.
 *
 * Reads the block's stored ACF field values via acf_setup_meta(), so it works
 * outside the block's own render context (i.e. during wp_head).
 *
 * @param array $blocks    Result of parse_blocks().
 * @param array $questions Collected Question nodes (by reference).
 * @return void
 */
function cb_collect_faq_questions($blocks, &$questions)
{
    foreach ($blocks as $block) {
        $is_faq_block = isset($block['blockName'])
            && $block['blockName'] === 'acf/cb_faq_block'
            && !empty($block['attrs']['data']);

        if ($is_faq_block) {
            $store = 'cb_faq_' . uniqid();
            acf_setup_meta($block['attrs']['data'], $store, true);

            if (have_rows('faq')) {
                while (have_rows('faq')) {
                    the_row();
                    $question = trim(wp_strip_all_tags((string) get_sub_field('question')));
                    $answer   = cb_faq_answer_html((string) get_sub_field('answer'));

                    if ($question !== '' && $answer !== '') {
                        $questions[] = array(
                            '@type'          => 'Question',
                            'name'           => $question,
                            'acceptedAnswer' => array(
                                '@type' => 'Answer',
                                'text'  => $answer,
                            ),
                        );
                    }
                }
            }

            acf_reset_meta($store);
        }

        if (!empty($block['innerBlocks'])) {
            cb_collect_faq_questions($block['innerBlocks'], $questions);
        }
    }
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
