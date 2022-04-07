function numberOfCharacters(textbox, limit, indicatore) {
    // Access the input in the textarea with document.getElementById(textbox).value
    // And
    // Access the length of current input with document.getElementById(textbox).value.length
    chars = document.getElementById(textbox).value.length;
  
    // Calculate the length of remaning characters and update the content of div element  with id characterLimit as the differnce
    document.getElementById(indicatore).innerHTML = limit - chars;
  }