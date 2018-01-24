<?php

class ViewModel {
    public function __get($name) {
        if (array_key_exists($name, $this->variables)) {
            return $this->variables[$name];
        }
    }

    public function __construct($variables, $layout) {
        $this->variables = $variables;
        $this->layout = $layout;
    }
    public function render($viewPath) {
        ob_start();
        require $viewPath;
        $content = ob_get_contents();
        ob_end_clean();
        ob_start();
        require $this->layout;
        $page = ob_get_contents();
        ob_end_clean();
        echo str_replace("{content}", $content, $page);
    }
}
