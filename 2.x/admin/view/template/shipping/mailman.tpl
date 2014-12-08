<?php echo $header; ?><?php echo $column_left; ?>
    <div id="content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="pull-right">
                    <button type="submit" form="form-flat" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                    <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
                <h1><?php echo $heading_title; ?></h1>
                <ul class="breadcrumb">
                    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="container-fluid">
            <?php if ($error_warning) { ?>
                <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php } ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
                </div>
                <div class="panel-body">
                    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-flat" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="mailman_wsdl_url"><?php echo $entry_wsdl_url; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="mailman_wsdl_url" value="<?php echo $mailman_wsdl_url; ?>" placeholder="<?php echo $entry_wsdl_url; ?>" id="mailman_wsdl_url" class="form-control" />
                                <?php if ($error_wsdl_url) { ?>
                                    <div class="text-danger"><?php echo $error_wsdl_url; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="mailman_username"><?php echo $entry_username; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="mailman_username" value="<?php echo $mailman_username; ?>" placeholder="<?php echo $entry_username; ?>" id="mailman_username" class="form-control" />
                                <?php if ($error_username) { ?>
                                    <div class="text-danger"><?php echo $error_username; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="mailman_password"><?php echo $entry_password; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="mailman_password" value="<?php echo $mailman_password; ?>" placeholder="<?php echo $entry_password; ?>" id="mailman_password" class="form-control" />
                                <?php if ($error_password) { ?>
                                    <div class="text-danger"><?php echo $error_password; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="mailman_parcel"><span data-toggle="tooltip" title="<?php echo $help_parcel; ?>"><?php echo $entry_parcel; ?></span></label>
                            <div class="col-sm-10">
                                <select name="mailman_parcel" id="mailman_parcel" class="form-control">
                                    <?php if ($mailman_parcel) { ?>
                                        <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                        <option value="0"><?php echo $text_no; ?></option>
                                    <?php } else { ?>
                                        <option value="1"><?php echo $text_yes; ?></option>
                                        <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="mailman_labels"><span data-toggle="tooltip" title="<?php echo $help_labels; ?>"><?php echo $entry_labels; ?></span></label>
                            <div class="col-sm-10">
                                <input type="text" name="mailman_labels" value="<?php echo $mailman_labels; ?>" placeholder="<?php echo $entry_labels; ?>" id="mailman_labels" class="form-control" />
                                <?php if ($error_labels) { ?>
                                    <div class="text-danger"><?php echo $error_labels; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="mailman_plata_ramburs"><span data-toggle="tooltip" title="<?php echo $help_plata_ramburs; ?>"><?php echo $entry_plata_ramburs; ?></span></label>
                            <div class="col-sm-10">
                                <select name="mailman_plata_ramburs" id="mailman_plata_ramburs" class="form-control">
                                    <?php if ($mailman_plata_ramburs) { ?>
                                        <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                        <option value="0"><?php echo $text_no; ?></option>
                                    <?php } else { ?>
                                        <option value="1"><?php echo $text_yes; ?></option>
                                        <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="mailman_asigurare_expeditie"><?php echo $entry_asigurare_expeditie; ?></label>
                            <div class="col-sm-10">
                                <select name="mailman_asigurare_expeditie" id="mailman_asigurare_expeditie" class="form-control">
                                    <?php if ($mailman_asigurare_expeditie) { ?>
                                        <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                        <option value="0"><?php echo $text_no; ?></option>
                                    <?php } else { ?>
                                        <option value="1"><?php echo $text_yes; ?></option>
                                        <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="mailman_min_gratuit"><?php echo $entry_min_gratuit; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="mailman_min_gratuit" value="<?php echo $mailman_min_gratuit; ?>" placeholder="<?php echo $entry_min_gratuit; ?>" id="mailman_min_gratuit" class="form-control" />
                                <?php if ($error_min_gratuit) { ?>
                                    <div class="text-danger"><?php echo $error_min_gratuit; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-tax-class"><?php echo $entry_tax_class; ?></label>
                            <div class="col-sm-10">
                                <select name="flat_tax_class_id" id="input-tax-class" class="form-control">
                                    <option value="0"><?php echo $text_none; ?></option>
                                    <?php foreach ($tax_classes as $tax_class) { ?>
                                        <?php if ($tax_class['tax_class_id'] == $mailman_tax_class_id) { ?>
                                            <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                            <div class="col-sm-10">
                                <select name="mailman_status" id="input-status" class="form-control">
                                    <?php if ($mailman_status) { ?>
                                        <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                        <option value="0"><?php echo $text_disabled; ?></option>
                                    <?php } else { ?>
                                        <option value="1"><?php echo $text_enabled; ?></option>
                                        <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="mailman_sort_order" value="<?php echo $mailman_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php echo $footer; ?>
