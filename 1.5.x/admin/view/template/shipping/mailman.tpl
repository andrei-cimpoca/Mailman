<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/shipping.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td><span class="required">*</span> <?php echo $entry_status; ?></td>
            <td><select name="mailman_status">
                <?php if ($mailman_status) { ?>
                <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                <option value="0"><?php echo $text_no; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_yes; ?></option>
                <option value="0" selected="selected"><?php echo $text_no; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td colspan=2>
                <span class="help"><b><?php echo $text_authentication; ?></b></span>
            </td>
          </tr>
            <tr>
                <td><span class="required">*</span> <?php echo $entry_wsdl_url; ?></td>
                <td><input type="text" name="mailman_wsdl_url" value="<?php echo $mailman_wsdl_url; ?>" />
                    <?php if ($error_wsdl_url) { ?>
                        <span class="error"><?php echo $error_wsdl_url; ?></span>
                    <?php } ?></td>
            </tr>
          <tr>
            <td><span class="required">*</span> <?php echo $entry_username; ?></td>
            <td><input type="text" name="mailman_username" value="<?php echo $mailman_username; ?>" />
              <?php if ($error_username) { ?>
              <span class="error"><?php echo $error_username; ?></span>
              <?php } ?></td>
          </tr>
          <tr>
            <td><span class="required">*</span> <?php echo $entry_password; ?></td>
            <td><input type="text" name="mailman_password" value="<?php echo $mailman_password; ?>" />
              <?php if ($error_password) { ?>
              <span class="error"><?php echo $error_password; ?></span>
              <?php } ?></td>
          </tr>
          <tr>
            <td colspan=2>
                <span class="help"><b><?php echo $text_awb_options; ?></b></span>
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_parcel; ?></td>
            <td><select name="mailman_parcel">
                <?php if ($mailman_parcel) { ?>
                <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                <option value="0"><?php echo $text_no; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_yes; ?></option>
                <option value="0" selected="selected"><?php echo $text_no; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><span class="required">*</span> <?php echo $text_labels; ?><br>&nbsp;</td>
            <td><input type="text" name="mailman_labels" value="<?php echo $mailman_labels; ?>" />
              <span class="help">Introduceti un numar intreg. Exemplu: 1 - daca expeditati 1 pachet / AWB.</span>
              <?php if ($error_labels) { ?>
              <span class="error"><?php echo $error_labels; ?></span>
              <?php } ?>
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_plata_ramburs; ?></td>
            <td><select name="mailman_plata_ramburs">
                <?php if ($mailman_plata_ramburs) { ?>
                <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                <option value="0"><?php echo $text_no; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_yes; ?></option>
                <option value="0" selected="selected"><?php echo $text_no; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_asigurare_expeditie; ?></td>
            <td><select name="mailman_asigurare_expeditie">
                <?php if ($mailman_asigurare_expeditie) { ?>
                <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                <option value="0"><?php echo $text_no; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_yes; ?></option>
                <option value="0" selected="selected"><?php echo $text_no; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $text_min_gratuit; ?></td>
            <td><input type="text" name="mailman_min_gratuit" value="<?php echo $mailman_min_gratuit; ?>" />
              <?php if ($error_min_gratuit) { ?>
              <span class="error"><?php echo $error_min_gratuit; ?></span>
              <?php } ?></td>
          </tr>
            <tr>
                <td><?php echo $entry_tax_class; ?></td>
                <td><select name="mailman_tax_class_id">
                        <option value="0"><?php echo $text_none; ?></option>
                        <?php foreach ($tax_classes as $tax_class) { ?>
                            <?php if ($tax_class['tax_class_id'] == $mailman_tax_class_id) { ?>
                                <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select></td>
            </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?>