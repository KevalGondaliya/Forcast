
<div class="row">
    <div class="col-lg-12">
        <h1>Data <small>Overview</small></h1>
        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-list"></i> Import Members</li>
        </ol>            
    </div>
</div>

<?php
$output = '';
$output .= form_open_multipart('ImportExcelController/save');
$output .= '<div class="row">';
$output .= '<div class="col-lg-12 col-sm-12"><div class="form-group">';
$output .= form_label('Import Sheet', 'image');
$data = array(
    'name' => 'userfile',
    'id' => 'userfile',
    'class' => 'form-control filestyle',
    'value' => '',
    'data-icon' => 'false'
);
$output .= form_upload($data);
$output .= '</div> <span style="color:red;">*Please choose an Excel file(.xls or .xlxs) as Input</span></div>';
$output .= '<div class="col-lg-12 col-sm-12"><div class="form-group text-right">';
$data = array(
    'name' => 'importfile',
    'id' => 'importfile-id',
    'class' => 'btn btn-primary',
    'value' => 'Import',
);
$output .= form_submit($data, 'Import Data');
$output .= '</div>
                        </div></div>';
$output .= form_close();
echo $output;
?>

<div class="table-responsive">
    <table border="1" class="table table-hover tablesorter">
        <thead>
            <tr>
                <th class="reg_no">Reg No.</th>
                <th class="owner_name">Owner Name</th>                           
                <th class="address">Address</th>                      
                <th class="regn_date">Registration Date</th>
                <th class="maker">Maker</th>
                <th class="maker_model">Maker Model</th>
                <th class="mobile">Mobile</th>                           
                <th class="import_date">Import Date</th>                      
                <th class="last_date">Last Date</th>
                <th class="next_date">Next Date</th>
                <th class="modify_date">Modify Date</th>
                <th class="note">Note</th>                           
                <th class="vehicle_type">Vehicle Type</th>  
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($employeeInfo) && !empty($employeeInfo)) {
                foreach ($employeeInfo as $key => $element) {
                    ?>
                    <tr>
                        <td><?php echo $element['reg_no']; ?></td> 
                        <td><?php echo $element['owner_name']; ?></td>                       
                        <td><?php echo $element['address']; ?></td>
                        <td><?php echo $element['regn_date']; ?></td>
                        <td><?php echo $element['maker']; ?></td>   
                        <td><?php echo $element['maker_model']; ?></td> 
                        <td><?php echo $element['mobile']; ?></td>                       
                        <td><?php echo $element['import_date']; ?></td>
                        <td><?php echo $element['last_date']; ?></td>
                        <td><?php echo $element['next_date']; ?></td>   
                        <td><?php echo $element['modify_date']; ?></td> 
                        <td><?php echo $element['note']; ?></td>     
                        <td><?php echo $element['vehicle_type']; ?></td>   
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="13">There is no employee.</td>    
                </tr>
            <?php } ?>

        </tbody>
    </table>
</div>