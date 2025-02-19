<?php
class Toolbar {
    private $buttons = [];
    
    public function addButton($icon, $link = '#', $title = '') {
        $this->buttons[] = [
            'icon' => $icon,
            'link' => $link,
            'title' => $title
        ];
    }
    
    public function render() {
        ob_start();
        ?>
        <div class="toolbar-container">
            <nav class="vertical-toolbar">
                <?php foreach ($this->buttons as $button): ?>
                    <a href="<?php echo htmlspecialchars($button['link']); ?>" 
                       class="toolbar-button"
                       title="<?php echo htmlspecialchars($button['title']); ?>">
                        <?php echo $button['icon']; ?>
                    </a>
                <?php endforeach; ?>
            </nav>
        </div>
        <?php
        return ob_get_clean();
    }
}
?>