///////
  <FORM METHOD="post" ACTION="xxx@gmail.com" ENCTYPE="multipart/form-data">
    <input id="uploadFile" placeholder="Add files from My Computer" class="steptextboxq3" />
    <div class="fileUpload btn btn-primary">
<span>Browse</span>

        <input id="uploadBtn" type="file" class="upload" multiple="multiple" name="browsefile" />
    </div>
    <input id="filename" type="text" />
    <div id="upload_prev"></div>
    <div style="clear:both;"></div>
</FORM>
<div class="buttonwrap">
<a href="#" class="buttonsend" style="float:right;">Send </a> 
</div>

<script>
  // define `files` , `res` variables
var files, res;

document.getElementById("uploadBtn").onchange = function (e) {
    e.preventDefault();
    document.getElementById("uploadFile").value = this.value;
};
document.getElementById('uploadBtn').onchange = uploadOnChange;

function uploadOnChange() {
    var filename = this.value;
    var lastIndex = filename.lastIndexOf("\\");
    if (lastIndex >= 0) {
        filename = filename.substring(lastIndex + 1);
    }
    files = $('#uploadBtn')[0].files;
    // set `res` to array of file objects
    res = Array.prototype.slice.call(files);
    for (var i = 0; i < files.length; i++) {
        $("#upload_prev")
        .append("<span>" + files[i].name + "</span> <b>X</b><br>");
    }
    document.getElementById('filename').value = filename;
}
// remove `file` from `res` 
// e.g., click `X` to remove file from `res`
$(document).on("click", "#upload_prev span", function () {

    if (res.length) {
      res.splice($(this).index(), 1);
      $(this).remove();
    }
    console.log(res);

});

// send adjusted `res` array of file objects to server
$(".buttonsend").on("click", function (e) {
    // $.post($("form").attr("action"), res)
    // e.preventDefault();
    // e.stopPropagation();
    if (res.length) {
        $.post("/echo/json/", {
          json: JSON.stringify(res)
        }).then(function (data) {
          console.log(data)
        })
    }
})
</script>
  //////// 