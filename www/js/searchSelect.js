function findDataInSelect(input, element){
    let searchBox = input;
    let users = element;

    console.log(searchBox);
    console.log(users);
    var when = "keyup"; //You can change this to keydown, keypress or change

    searchBox.addEventListener("keyup", function (e) {
        var text = e.target.value;
        var options = users.options;

        for (var i = 0; i < options.length; i++) {
            options[i].removeAttribute("hidden");
        }

        for (var i = 0; i < options.length; i++) {
            var option = options[i];
            var optionText = option.text;
            var lowerOptionText = optionText.toLowerCase();
            var lowerText = text.toLowerCase();
            var regex = new RegExp("^" + text, "i");
            var match = optionText.match(regex);
            var contains = lowerOptionText.indexOf(lowerText) != -1;
            if (match || contains) {
                option.selected = true;
                //return;
            }else{
                option.hidden = true;
            }

            if(text.length === 0) {
                for (var j = 0; j < options.length; j++)
                    options[j].removeAttribute("hidden");
            }

            searchBox.selectedIndex = 0;
        }
    });
}