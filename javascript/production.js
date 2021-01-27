var counter = 1; //repeatedly count 1 
setInterval(function(){
    document.getElementById('radio' + counter).checked = true; 
    //'+'addition. String concatenation
    //checking one radio button at a time. 
    counter++ //repeat
    if(counter > 5){ 
        counter = 1;
    }
}, 3000); //3000 miliseconds

