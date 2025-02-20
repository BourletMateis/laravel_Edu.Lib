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

// Créer une instance de la barre d'outils globale
$toolbar = new Toolbar();

// Ajouter les boutons
$toolbar->addButton('
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
        <polyline points="9 22 9 12 15 12 15 22"/>
    </svg>
', '/', 'Accueil');

$toolbar->addButton('
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="4" width="18" height="16" rx="2" ry="2"/>
        <line x1="16" y1="2" x2="16" y2="6"/>
        <line x1="8" y1="2" x2="8" y2="6"/>
        <line x1="3" y1="10" x2="21" y2="10"/>
    </svg>
', '/calendar', 'Calendrier');
$toolbar->addButton('
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
        <circle cx="12" cy="7" r="4"/>
    </svg>
', '/profil', 'Profil');

?>
