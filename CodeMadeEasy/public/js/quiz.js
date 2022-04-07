
function show_hide(element)
{
    // Initialize Var
   var myAnswer = element.nextElementSibling;

   var displaySetting = myAnswer.style.display;

   var quizButton = element;

   if(displaySetting=="inline-block"){
       myAnswer.style.display = 'none'; // Gives the answer no css so it doesnt display

       quizButton.innerHTML = 'Show Solution'; // Button displays "Show Solution"
   }
   else
   {
       myAnswer.style.display = 'inline-block'; // Gives the answer css to display 
       quizButton.innerHTML = 'Hide Solution'; // Button displays "Hide Solution"
   }
}
