let text = "Is there a Problem? <br>Do something 'bout it!<br>Sign Up!!<br>Today?<br>";
let index = 0;
let delayAfterBreak = false; 
let colorIndex = 0;
const colors = ["#0693e3", "#e35606", "#0693e3", "#e35606"]; 

function typeEffect() {
    if (index < text.length) {
        let char = text.charAt(index);

        if (char === "<") {
            let nextPart = text.substring(index, index + 4);
            if (nextPart === "<br>") {
                document.getElementById("typing-text").innerHTML += "<br>";
                index += 4;
                delayAfterBreak = true; 
                document.getElementById("typing-text").style.color = colors[colorIndex % colors.length];
                colorIndex++;
            }
        } else {
            document.getElementById("typing-text").innerHTML += char;
            index++;
            delayAfterBreak = false;
        }

        let delay = delayAfterBreak ? 1200 : 75;
        setTimeout(typeEffect, delay);
    }
}

window.onload = function () {
    typeEffect();
};
