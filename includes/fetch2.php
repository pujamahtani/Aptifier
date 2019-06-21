<?php
if($_POST['user_type_id'] == 5){
    echo ' <label>Class:</label>
        <select name="user_class_id">
        <option>...</option>
            <option value="1">D1</option>
            <option value="2">D2</option>
            <option value="3">D3</option>
            <option value="4">D4</option>
            <option value="5">D5</option>
            <option value="6">D6</option>
            <option value="7">D7</option>
            <option value="8">D8</option>
            <option value="9">D9</option>
            <option value="10">D10</option>
            <option value="11">D11</option>
            <option value="12">D12</option>
            <option value="13">D13</option>
            <option value="14">D14</option>
            <option value="15">D15</option>
            <option value="16">D16</option>
            <option value="17">D17</option>
            <option value="18">D18</option>
            <option value="19">D19</option>
            <option value="20">D20</option>
        </select>
        <label>Branch:</label>         
         <select name="user_branch">
         <option>...</option>
            <option value="1">CMPN</option>
            <option value="2">IT</option>
            <option value="3">EXTC</option>
            <option value="4">ETRX</option>
            <option value="5">IS</option>
            <option value="6">MCA</option>
            
        </select>
        <label>Division:</label>
        <select name="user_division">
        <option>...</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
        </select>
       ';
    
}
else if($_POST['user_type_id'] == 3){
    echo ' <label>Branch:</label>         
         <select name="user_branch">
         <option>...</option>
            <option value="1">CMPN</option>
            <option value="2">IT</option>
            <option value="3">EXTC</option>
            <option value="4">ETRX</option>
            <option value="5">IS</option>
            <option value="6">MCA</option> 
        </select>
        <label>Designation:</label>
        <select name="user_designation">
        <option>...</option>
            <option value="1">PRINCIPAL</option>
            <option value="2">VICE-PRINCIPAL</option>
            <option value="3">PROFESSOR</option>
            <option value="4">ASSISTANT PROFESSOR</option>
            <option value="5">TEMPORARY</option>
            </select>
        ';
}
else{
    echo "";
}
?>