function show_rated_on_other_category(ele) {
    //if button was click on rated bar show rated question to different category
    let value_button = ele.value;

    const array = ['A', 'B', 'C', 'D', 'T'];

    //check which index of array is selected category
    let array_index = 0;
    for(let i=0; i<array.length; i++) {
        if(array[i] == value_button) {
            change_display(value_button, "flex");
            console.log(value_button);
        }
        else {
            change_display(array[i], "none");
        }
    }
}

function change_display(className, display) {
    let rated_category = document.querySelectorAll("."+className);
    for(let y=0; y<rated_category.length; y++) {
        rated_category[y].style = "display: "+display+";";
       }
}