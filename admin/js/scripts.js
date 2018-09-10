$(document).ready(function(){
    $("#selectAllBoxes").click(function(event){
        if(this.checked){
            $(".checkBoxes").each(function(){
                this.checked = true;
            });
        }else{
            $(".checkBoxes").each(function(){
                this.checked = false;
            });
        }
    });
    
   //reloading users online without refreshing
    
    function loadUsers(){
        $.get("functions.php?onlineusers=result",function(data){
            $(".usersonline").text(data);
        });
    }
    
   setInterval(function(){
       loadUsers();
   },500);
    
});


