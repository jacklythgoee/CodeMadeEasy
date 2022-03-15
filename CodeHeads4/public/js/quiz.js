
var navLinks = document.getElementById("navLinks")

function showMenu(){
    navLinks.style.right = "0";
}
function hideMenu(){
    navLinks.style.right = "-200px";
}

function show_hide(element)
{
   var myAnswer = element.nextElementSibling;

   var displaySetting = myAnswer.style.display;

   var quizButton = element;

   if(displaySetting=="inline-block"){
       myAnswer.style.display = 'none';

       quizButton.innerHTML = 'Show Solution';
   }
   else
   {
       myAnswer.style.display = 'inline-block';
       quizButton.innerHTML = 'Hide Solution';
   }
}
