//step 1 start camera section
var video = document.getElementById("MyCameraOpen");
var text = document.getElementById("text");
//var teacher = document.getElementById("teacher");
var course = document.getElementById("course");
//var date = document.getElementById("date");

 var scanner = new Instascan.Scanner({
    video : video
});
Instascan.Camera.getCameras()
.then(function(Our_Camera){
    if(Our_Camera.length > 0){
        scanner.start(Our_Camera[0]);
    }else{
        alert("camera failed");
    }
})
.catch(function(error){
    console.log("error please try again");
})


// input text section step 2
scanner.addListener('scan',function(input_value){
    if((input_value)!=" ")
{
    swal({
        title: "Successfully submitted!",
        text: "Submitted",
        icon: "success",
        button: "OK",
      });
      
}
    var str=input_value;
    course.value=str;
    date.value=d;
    teacher.value=tid;
})