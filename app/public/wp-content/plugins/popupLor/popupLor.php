<?php
/*
Plugin Name: Popup Lor
Description: Une extension simple pour afficher une popup.
Version: 1.0
Author: lorlor31
*/

function popup_extension_enqueue_scripts() {
    wp_enqueue_script('popup-js', plugin_dir_url(__FILE__) . 'popupLor.js', array(), '1.0', true);
    wp_enqueue_style('popup-css', plugin_dir_url(__FILE__) . 'popupLor.css');
}

add_action('wp_enqueue_scripts', 'popup_extension_enqueue_scripts');

function popup_extension_html() {
    echo '<div id="popup" class="popup">
            <div class="popup-content">
                <span class="close-btn">&times;</span>
                <p>Ceci est une popup!</p>
            </div>
          </div>';
}

add_action('wp_footer', 'popup_extension_html');

function administration_add_admin_page() {
    add_submenu_page(
       'options-general.php',
       'Mes options',
       'Mes réglages',
       'manage_options',
       'administration',
       'administration_page'
    );
   }
   

    function administration_page() {
        $couleurs_disponibles = array(
           'ffffff' => 'Blanc',
           '000000' => 'Noir',
           'ff0000' => 'Rouge',
           '00ff00' => 'Vert',
           '0000ff' => 'Bleu'
        );
       
       if (isset($_POST['submit'])) {
           update_option('couleur_fond_site', $_POST['fond_couleur']);
    }
       
        $couleur_actuelle = get_option('couleur_fond_site');
        ?>
        <div class="wrap">
           <h1>Mes options</h1>
           <form method="post" action="">
               <label for="fond_couleur">Choisissez une couleur : </label>
                   <select id="fond_couleur" name="fond_couleur">
                    <?php foreach ($couleurs_disponibles as $valeur => $libelle) { ?>
                     <option value="<?php echo $valeur; ?>" <?php selected($couleur_actuelle, $valeur); ?>><?php echo $libelle; ?></option>
                    <?php } ?>
                   </select>
                   <input type="submit" name="submit" class="button button-primary" value="Enregistrer" />
           </form>
        </div>
        <?php
       }
   
   add_action('admin_menu', 'administration_add_admin_page');


   function ajouter_couleur_fond_site() {
    $couleur_fond = get_option('couleur_fond_site');
    ?>
    <style>
    body {
    background-color: #<?php echo esc_attr($couleur_fond); ?>;
    }
    </style>
    <?php
    }
    
    add_action('wp_head', 'ajouter_couleur_fond_site');
?>
