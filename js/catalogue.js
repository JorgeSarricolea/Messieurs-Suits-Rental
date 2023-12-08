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
  console.log(search);
  const type =
    filterType || document.querySelector(".active")?.textContent || "Suits";

  fetchCatalogue(type, search);
  console.log(type);
}

function fetchCatalogue(type, search) {
  // AJAX call to PHP file
  fetch(`php/../../routes/fetch_catalogue.php?type=${type}&search=${search}`)
    .then((response) => response.json())
    .then((data) => {
      const catalogue = document.getElementById("catalogue");
      catalogue.innerHTML = ""; // Clear the current catalogue

      if (data.length === 0) {
        // No results
        const noResultsDiv = document.createElement("div");
        noResultsDiv.className = "no-results";
        noResultsDiv.textContent = "No hay resultados disponibles :(";
        catalogue.appendChild(noResultsDiv);
      } else {
        // Results
        data.forEach((item) => {
          // Create and add each item to the catalogue
          const div = document.createElement("div");
          div.className = "catalogue-item";
          div.innerHTML = `
            <img src="${item.image_src}" alt="${item.model}">
            <h3>${item.model}</h3>
            <p>Color: <span>${item.color}</span></p>
            <p id="price-text">Price: $${item.price.toFixed(2)}</p>
          `;
          catalogue.appendChild(div);
        });
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      const catalogue = document.getElementById("catalogue");
      catalogue.innerHTML = ""; // Clear the current catalogue
      const errorDiv = document.createElement("div");
      errorDiv.className = "error-message";
      errorDiv.textContent = "Error al cargar el catálogo";
      catalogue.appendChild(errorDiv);
    });
}

// Start the catalog with default Suits
filterCatalogue("Suits");
