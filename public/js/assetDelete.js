
 $(".delete").on("click", function(){
   
        var _this = $(this);
        var id = $(this).data("id");
        var token = $(this).data("token");
        $.ajax(
        {
            url: "/asset/delete",
            type: 'get',
            dataType: "JSON",
            data: {
                "id": id,
                "_method": 'DELETE',
                "_token": token,
            },
            success: function ()
            {
              _this.parent().parent().remove();
                console.log("it Work");
            }
        });

        console.log("It failed");
    });
     
          
        
          
            
            
            