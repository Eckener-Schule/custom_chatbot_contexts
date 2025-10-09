<?php
if (!defined( 'ABSPATH')) {
	die;
}

class CustomChatbotContexts {
    public static function init() {
        $class = __CLASS__;
        new $class;
    }
    public function __construct() {
        $this->init_hooks();
    }
    private function init_hooks() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        add_action('wp_footer', [$this, 'inject_html']);
    }
    public function inject_html() {
        ?>
        <div id="wps-custom_chatbot_contexts">
            <div id="chat-window" style="display: none;">
                <div class="titlebar">
                    <div class="title">Simple Chatbot</div>
                    <svg onclick="custom_chatbot_contexts_toggle_overlay()" class="close-btn" width="1rem" height="1rem" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="white"/>              
                    </svg>
                </div>    
                <div class="box">
                </div>
                <div class="typing-area">
                    <form id="chat-form" class="input-field">
                        <input type="text" placeholder="Type your message" required>
                        <button type="submit">Send</button>
                    </form>
                </div>
            </div>
            <div onclick="custom_chatbot_contexts_toggle_overlay()" id="open-overlay">💬</div>
        </div>
        <?php
    }
    public function enqueue_assets() {
        wp_register_script('script', WP_URL . 'assets/js/script.js', array('jquery'), null );
        wp_enqueue_script('script');

        wp_register_style('style', WP_URL . 'assets/css/style.css', array(), null );
        wp_enqueue_style('style');
    }
}
?>