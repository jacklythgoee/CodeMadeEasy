function numberOfCharacters(textbox,limit,indicatore){
  chars = document.getElementById(textbox) .value.length;
  document.getElementById(indicatore).innerHTML = limit-chars;

}