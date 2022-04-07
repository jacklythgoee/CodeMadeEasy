function tableSearch(){
    let input, filter, table, tr, td, h, txtValue;

    //Initializing Var
    input = document.getElementById("myInput"); //find input element
    filter = input.value.toUpperCase(); //the search value in user's search input
    table = document.getElementById("myTable"); //don't see anywhere using this variable
    tr = document.getElementsByTagName("tr"); //get all `tr` (maybe from your table?)

    //loop through all `tr`
    for(let h = 0; h < tr.length; h++){
        //get only first `td` from the current `tr` (`tr` is based on index)
        td = tr[h].getElementsByTagName("td")[0];
        //if found the first `td`
        if(td){

            //get the first `td` content
            txtValue = td.textContent || td.innerText;
 
            //if the first `td` content matches with your search input
            //show the entire current `tr`
            if(txtValue.toUpperCase().indexOf(filter) > -1){
                tr[h].style.display = "";
            }
            //if the first `td` content does not with your search input
            //hide the entire current `tr`
            else {
                tr[h].style.display = "none";
            }
        }
    }
}