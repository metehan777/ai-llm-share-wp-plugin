<?php
/**
 * Plugin Name: ChatGPT, Perplexity & Social Share Buttons
 * Description: Adds share buttons for ChatGPT, Perplexity, WhatsApp, LinkedIn, and X to single post pages.
 * Version: 1.5
 * Author: YourName
 */

add_filter('the_content', 'multi_share_buttons');

function multi_share_buttons($content) {
    if (!is_single()) return $content;

    $post_url = get_permalink();
    $post_title = get_the_title();
    $encoded_url = urlencode($post_url);
    $encoded_title = urlencode($post_title);

    $chatgpt_url = 'https://chat.openai.com/?q=' . urlencode("Visit this URL and summarize this post for me: " . $post_url);
    $perplexity_url = 'https://www.perplexity.ai/search/new?q=' . urlencode("Visit this URL and summarize the post for me: " . $post_url);
    $whatsapp_url = "https://api.whatsapp.com/send?text={$encoded_title}%20{$encoded_url}";
    $linkedin_url = "https://www.linkedin.com/sharing/share-offsite/?url={$encoded_url}";
    $x_url = "https://twitter.com/intent/tweet?text=" . urlencode("{$post_title} by @appsamurai") . "&url={$encoded_url}";

    $buttons_html = <<<HTML
<div style="margin: 20px 0;">
    <strong>Share/Research at:</strong>
    <div style="margin-top: 10px; display: flex; gap: 10px; flex-wrap: wrap;">
        <a href="$chatgpt_url" target="_blank" style="display: inline-flex; align-items: center; padding: 8px 14px; background-color: #10a37f; color: #fff; border-radius: 25px; font-weight: bold; text-decoration: none; font-size: 14px;">
            ChatGPT
        </a>
        <a href="$perplexity_url" target="_blank" style="display: inline-flex; align-items: center; padding: 8px 14px; background-color: #6f42c1; color: #fff; border-radius: 25px; font-weight: bold; text-decoration: none; font-size: 14px;">
            Perplexity
        </a>
        <a href="$whatsapp_url" target="_blank" style="display: inline-flex; align-items: center; padding: 8px 14px; background-color: #25D366; color: #fff; border-radius: 25px; font-weight: bold; text-decoration: none; font-size: 14px;">
            WhatsApp
        </a>
        <a href="$linkedin_url" target="_blank" style="display: inline-flex; align-items: center; padding: 8px 14px; background-color: #0077b5; color: #fff; border-radius: 25px; font-weight: bold; text-decoration: none; font-size: 14px;">
            LinkedIn
        </a>
        <a href="$x_url" target="_blank" style="display: inline-flex; align-items: center; padding: 8px 14px; background-color: #000000; color: #fff; border-radius: 25px; font-weight: bold; text-decoration: none; font-size: 14px;">
            X
        </a>
    </div>
</div>
HTML;

    return $buttons_html . $content . $buttons_html;
}