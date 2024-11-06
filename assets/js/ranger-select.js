let rangeMin = 50; // Minimum gap between min and max
const range = document.querySelector(".range-selected");
const rangeInput = document.querySelectorAll(".range-input input");
const rangePrice = document.querySelectorAll(".range-price input");
const tooltipMin = document.getElementById("tooltip-min");
const tooltipMax = document.getElementById("tooltip-max");

function updateTooltips() {
    const minValue = rangeInput[0].value;
    const maxValue = rangeInput[1].value;

    tooltipMin.textContent = minValue + "$";
    tooltipMax.textContent = maxValue + "$";

    // Calculate the percentage position for tooltips
    const minPercentage = (minValue / rangeInput[0].max) * 100;
    const maxPercentage = (maxValue / rangeInput[1].max) * 100;

    // Update tooltip position
    tooltipMin.style.left = `calc(${minPercentage}% + 10px)`;
    tooltipMax.style.left = `calc(${maxPercentage}% - 10px)`;
}

rangeInput.forEach((input) => {
    input.addEventListener("input", (e) => {
        let minRange = parseInt(rangeInput[0].value);
        let maxRange = parseInt(rangeInput[1].value);

        if (maxRange - minRange < rangeMin) {
            if (e.target.classList.contains("min")) {
                rangeInput[0].value = Math.max(minRange, maxRange - rangeMin);
            } else {
                rangeInput[1].value = Math.min(maxRange, minRange + rangeMin);
            }
        }

        minRange = parseInt(rangeInput[0].value);
        maxRange = parseInt(rangeInput[1].value);

        range.style.left = (minRange / rangeInput[0].max) * 100 + "%";
        range.style.right = 100 - (maxRange / rangeInput[1].max) * 100 + "%";

        rangePrice[0].value = minRange;
        rangePrice[1].value = maxRange;

        updateTooltips();
    });
});

rangePrice.forEach((input) => {
    input.addEventListener("input", (e) => {
        let minPrice = parseInt(rangePrice[0].value);
        let maxPrice = parseInt(rangePrice[1].value);

        if (maxPrice - minPrice >= rangeMin && maxPrice <= rangeInput[1].max) {
            if (e.target.name === "min") {
                minPrice = Math.min(minPrice, maxPrice - rangeMin);
                rangeInput[0].value = minPrice;
                range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
            } else {
                maxPrice = Math.max(maxPrice, minPrice + rangeMin);
                rangeInput[1].value = maxPrice;
                range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
            }

            rangePrice[0].value = minPrice;
            rangePrice[1].value = maxPrice;

            updateTooltips();
        }
    });
});

// Initial tooltip update on page load
updateTooltips();
