<?php
// Plugin "Pending Reboot" OCSInventory
// Author: Léa DROGUET

if(AJAX){
    parse_str($protectedPost['ocs']['0'], $params);
    $protectedPost+=$params;
    ob_start();
    $ajax = true;
}
else{
    $ajax=false;
}
    print_item_header($l->g(47000));

	if (!isset($protectedPost['SHOW'])){
        $protectedPost['SHOW'] = 'NOSHOW';
    }
	$form_name="pendingreboot";
	$table_name=$form_name;
    $tab_options=$protectedPost;
    $tab_options['form_name']=$form_name;
    $tab_options['table_name']=$table_name;
    echo open_form($form_name);
	$list_fields = array(
        'Last Checked' => 'LAST_CHECKED',
        'Pending Reboot' => 'PENDING_REBOOT'
    );
    $list_col_cant_del=$list_fields;
    $default_fields= $list_fields;
    $sql=prepare_sql_tab($list_fields);

    $sql['SQL']  .= "FROM $table_name WHERE (hardware_id = $systemid)";
    array_push($sql['ARG'],$systemid);
    $tab_options['ARG_SQL']=$sql['ARG'];
    $tab_options['ARG_SQL_COUNT']=$systemid;
    ajaxtab_entete_fixe($list_fields,$default_fields,$tab_options,$list_col_cant_del);
    echo close_form();
    if ($ajax){
        ob_end_clean();
        tab_req($list_fields,$default_fields,$list_col_cant_del,$sql['SQL'],$tab_options);
        ob_start();
    }
