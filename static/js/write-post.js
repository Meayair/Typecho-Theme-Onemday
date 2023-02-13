$(document).ready(function() {
    var w = $('#edit-secondary').width();
    var h = w*4/3;
    $('p.title').append('<span id="dbSearch"><img style="width:20px;height:20px" class="link-img" src="/usr/themes/onemday/static/images/link/doubangrey.svg"></span>');
    $(document).on('click', '#dbSearch', function() {
        $("#suggest").remove();
        $("#maoyan").remove();
        var q = $("input#title").val();
        if (q !== null || q !== undefined || q !== '') {
            $.ajax({
                type: "GET",
                url: " /usr/themes/onemday/api/getSearchSuggestFromDouban.php?q=" + q,
                dataType: "json",
                success: function(data) {
                    //console.log(data);
                    strHtml = "<ul id = \"suggest\">";
                    for (i = 0; i < data.length; i++) {
                        strHtml += "<li><iframe style=\"border: unset;width:"+ w +"px;height:" + h+ "px;\" src=\"/usr/themes/onemday/api/imgNoReferrer.php?img=" + data[i]["img"] + "\" scrolling=\"no\"></iframe><a data-id=\"" + data[i]["id"] + "\">" + data[i]["title"] + "</a></li>";
                    }
                    strHtml += "</ul>";
                    $('#edit-secondary').append(strHtml);
                    


                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

    })
    $(document).on('click','#maoyan li a',function(){
        var id = $(this).data("id");
        $.ajax({
            type: "GET",
            url: " /usr/themes/onemday/api/getDialoguesFromMaoyan.php?id=" + id,
            dataType: "json",
            success: function(data) {
                $("#maoyan").remove();
                strHtml = "<ul id = \"maoyan\">";
                    for (i = 0; i < data.length; i++) {
                        strHtml += "<li><p>"+ data[i] +"</p></li>";
                    }
                strHtml += "</ul>";
                $('#edit-secondary').append(strHtml);
            },
            error: function(error) {
                console.log(error);
            }
        });
    })
    $('#edit-secondary').on('click','#suggest li a',function(){
        var id = $(this).data("id");
        $.ajax({
                type: "GET",
                url: " /usr/themes/onemday/api/getInfoFromDouban.php?id=" + id,
                dataType: "json",
                success: function(data) {
                    $("input#title").val(data.title);
                    $("input[name=\"fields[dbPoint]\"]").val(data.point);
                    $("input[name=\"fields[tags]\"]").val(data.genres);
                    $("input[name=\"fields[area]\"]").val(data.area);
                    $("input[name=\"fields[year]\"]").val(data.year);
                    $("input[name=\"fields[director]\"]").val(data.directedBys);
                    $("input[name=\"fields[actor]\"]").val(data.stars);
                    $("textarea[name=\"fields[movdes]\"]").val(data.desc);
                    $("textarea[id=\"text\"]").val(data.text);
                    for(var i=0;i<data.genres.length;i++){
                        $('#tags').tokenInput('add',{id:data.genres[i],tags:data.genres[i]})
                        
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
    })
})