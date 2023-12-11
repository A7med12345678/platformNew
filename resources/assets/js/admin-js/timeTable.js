// Function to update the content of the spans
function updateSpanContent() {
    totalValues.forEach((value, index) => {
        // Create a unique ID for the span based on the value and index
        const spanId = `${value}`;

        const spanElement = document.getElementById(spanId);

        if (spanElement) {
            spanElement.innerHTML = typeValues[index];

            if (typeValues[index] === 'exam') {
                spanElement.style.color = "white";
            }
        }
    });
}

// Call the function to update span content
updateSpanContent();
