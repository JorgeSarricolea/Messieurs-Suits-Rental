function filterCatalogue(type) {
  // Highlight the active filter option
  document.querySelectorAll(".filter-option").forEach((element) => {
    if (element.textContent === type) {
      element.classList.add("active");
    } else {
      element.classList.remove("active");
    }
  });

  // Perform the search with the filter applied
  search(type);
}

function search(filterType) {
  const searchBox = document.getElementById("searchBox");
  const search = searchBox.value;
  const type =
    filterType || document.querySelector(".active")?.textContent || "Suits";

  fetchCatalogue(type, search);
}

function fetchCatalogue(type, search) {
  // AJAX call to your PHP file
  fetch(`php/../../routes/fetch_catalogue.php?type=${type}&search=${search}`)
    .then((response) => response.json())
    .then((data) => {
      const catalogue = document.getElementById("catalogue");
      catalogue.innerHTML = ""; // Clear the current catalog
      data.forEach((item) => {
        // Create and add each item to the catalog
        const div = document.createElement("div");
        div.className = "catalogue-item";
        div.innerHTML = `
          <img src="${item.image_src}" alt="${item.model}">
          <h3>${item.model}</h3>
          <p>Color: ${item.color}</p>
          <p>Price: $${item.price.toFixed(2)}</p>
        `;
        catalogue.appendChild(div);
      });
    })
    .catch((error) => console.error("Error:", error));
}

// Start the catalog with default SuitJackets
filterCatalogue("Suits");
