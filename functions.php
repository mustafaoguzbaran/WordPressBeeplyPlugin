<?php
 $tableName = $wpdb -> prefix."beeply";
const ABSPATH = "";
//Bu fonksiyon admin panelin önyüzünü görüntüler.
function beeply_content(){?>
    <div class="beeply_admin_panel_frontend">
    <form method="POST">
        <label>Duyuracağınız içeriği giriniz: 
        <input type ="text" name ="notification" placeholder="Duyurunuzu giriniz..."></input></label><br>
        <label>Link eklemek isterseniz, linkinizi buraya yapıştırın.
        <input type="text" name="notification_url" placeholder="https://url.com..."></input></label>
        <label><br>
        <label> Duyuru barı HEX kodunu yazınız:
            <input type="text" name="notification-bar-color" placeholder="#000000"></input>
        </label><br>
            <input type="submit" value="Duyuru Yayımla!"></input>
        </label>
    </form>
</div>
<?php

add_data_bepply();
data_fetch_beeply();
} 
// Bu fonksiyon eklenti etkinleştirildiğinde veritabanında otomatik olarak tablo oluşturur.
function add_table_beeply(){
    global $wpdb;
    $charset = $wpdb -> get_charset_collate();
    $tableName = $wpdb -> prefix."beeply";
    $sql = "CREATE TABLE $tableName(
        id INT (9) NOT NULL AUTO_INCREMENT,
        notification VARCHAR(300) NOT NULL,
        notification_url VARCHAR(300),
        UNIQUE KEY id (id)
    ) $charset;";
    require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    register_activation_hook( __FILE__, "creating_plugin_table" );
}
// Bu fonksiyon veritabanına veri eklemeyi sağlar.
function add_data_bepply(){
    global $wpdb;
    global $tableName;
    $wpdb -> insert("$tableName", array(
        "notification" => $_POST["notification"],
        "notification_url" => $_POST["notification_url"]
    ));
}
//Bu fonksiyon veri tabanındaki verileri çekmemize olanak tanır.
function data_fetch_beeply(){
    global $wpdb;
    global $tableName;
    $wp_fetchData = $wpdb -> get_results("SELECT * FROM $tableName", OBJECT);
    if(count($wp_fetchData)):
foreach($wp_fetchData as $wp_fetchRow):
    echo "<br>";
    echo "id: " .$wp_fetchRow -> id. " İçerik: " .$wp_fetchRow -> notification. " URL: " .$wp_fetchRow -> notification_url;
    echo '
    <form method="POST">
    <input type="submit" value="Duyuruyu Veritabanından Sil" name="delete"></input>
    </form>
    ';
    echo $_POST['notification-bar-color'];
    delete_data_beeply($wp_fetchRow->id);
endforeach;
else:
    "Üzgünüm herhangi bir veri bulunamadı.";
    endif;
}
//Bu fonksiyon veritabanındaki verileri silmemize olanak tanır.
function delete_data_beeply($id){
    global $wpdb;
    global $tableName;
    if ($_POST["delete"]){
        $wpdb -> query($wpdb ->prepare("DELETE FROM $tableName WHERE id = $id"));
        echo '<meta http-equiv="refresh" content="0.000001;URL=admin.php?page=beeply">';
    }
}
function beeply_frontend(){
global $wpdb;
global $tableName;
$fetchNotifications = $wpdb -> get_results("SELECT * FROM $tableName", OBJECT);
if(count($fetchNotifications)){
foreach($fetchNotifications as $fetchNotification){
    
    $fetchDataIndex = $fetchNotification;
}
}
    $pluginPath = plugin_dir_url( __FILE__ );
    ?>
    <?php
    if($fetchNotification == NULL){

    }else{?>
<link rel="stylesheet" type="text/css" href="<?php echo $pluginPath. "style.css"; ?>">
<script src="https://kit.fontawesome.com/114cf4f071.js" crossorigin="anonymous"></script>
<div class="notification-bar"><center><a href ="<?php echo $fetchNotification -> notification_url;?>"><i class="fa-solid fa-bell" style="margin-right: 5px"></i><?php echo($fetchDataIndex->notification) ?></a></center></div>
<?php   
    } 
    ?>

<?php
}
?>