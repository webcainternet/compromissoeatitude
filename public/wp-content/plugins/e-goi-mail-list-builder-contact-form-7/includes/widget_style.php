<?php $EgoiMailListBuilderContactForm7 = get_option('EgoiMailListBuilderContactForm7Object'); ?>
<div class='wrap'>
    <div id="icon-egoi-mail-list-builder-contact-form-7-widget-style" class="icon32"></div>
    <h2>Widget Style</h2>
    <?php require('donate.php'); ?>
    <?php if($EgoiMailListBuilderContactForm7->isAuthed() && in_array( 'contact-form-7/wp-contact-form-7.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ))	{
        $real_file = EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_DIR.'assets/css/egoi-style.css';

        if(isset($_POST['egoi_mail_list_builder_contact_form_7_style_save'])){
            if(isset($_POST['egoi_mail_list_builder_contact_form_7_style_content'])){
                $newcontent = stripslashes($_POST['egoi_mail_list_builder_contact_form_7_style_content']);
                if ( is_writeable($real_file) ) {
                    $f = fopen($real_file, 'w+');
                    fwrite($f, $newcontent);
                    fclose($f);
                }

            }
        }
        egoi_mail_list_builder_contact_form_7_admin_notices();
        ?>
        <h3>Edit Widget Style</h3>
        <form name='egoi_mail_list_builder_contact_form_7_settings_form' method='post' action='<?php echo $_SERVER['REQUEST_URI']; ?>'>
            <table class="form-table">
                <tr>
                    <th>
                        <label for="egoi_mail_list_builder_contact_form_7_style_content">egoi-style.css</label>
                    </th>
                    <td>
                        <?php
                        $content = file_get_contents( $real_file );

                        $content = esc_textarea( $content );

                        $args = array(
                            'textarea_name' => "egoi_mail_list_builder_contact_form_7_style_content",
                            'quicktags' => false,
                            'media_buttons' =>false,
                            'drag_drop_upload' => false,
                            'teeny' => false,
                            'tinymce' => false,
                            'tabindex' => 1
                        );

                        wp_editor($content,'egoi_mail_list_builder_contact_form_7_style_content',$args);
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>
                        <input type="submit" class='button-primary' name="egoi_mail_list_builder_contact_form_7_style_save" id="egoi_mail_list_builder_contact_form_7_style_save" value="Save" />
                    </th>
                </tr>
            </table>
        </form>
    <?php }	?>
