<?php




?>
<form method="post" action="{{url('delete/User')}}">
    @csrf
    <input type="text" name="userid" value="58">
    <input type="submit" name="btndelete" value="حذف">
</form>
