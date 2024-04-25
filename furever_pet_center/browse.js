document.addEventListener("DOMContentLoaded", function() {
    // This function will run when the DOM is fully loaded

    // Call your function here
    // sortTableBycolumn(document.querySelector("table"), 5, false);

    document.querySelectorAll(".table-sortable th").forEach(headerCell => headerCell.addEventListener("click", (() => {
        const tableElement = headerCell.parentElement.parentElement.parentElement;
        const headerIndex = Array.prototype.indexOf.call(headerCell.parentElement.children, headerCell);
        const currentIsAscending = headerCell.classList.contains("th-sort-asc");

        sortTableBycolumn(tableElement, headerIndex, !currentIsAscending);
        
        
    })))





});

// function to sort table by column
function sortTableBycolumn(table, column, asc = true) {
    // Check if table exists
    if (!table || !table.tBodies || table.tBodies.length === 0) {
        console.error("Table or tbody not found.");
        return;
    }

    const dirModifier = asc ? 1 : -1;
    const tBody = table.tBodies[0]; // Accessing the first tbody
    const rows = Array.from(tBody.querySelectorAll("tr"));

    const sortedRows = rows.sort((a, b) => {
        const acol = a.querySelector(`td:nth-child(${column + 1})`).textContent.trim();
        const bcol = b.querySelector(`td:nth-child(${column + 1})`).textContent.trim();

       
        return acol > bcol ? (1 * dirModifier) : (-1 * dirModifier);
    })


   while (tBody.firstChild) {
        tBody.removeChild(tBody.firstChild);
    }
    

    tBody.append(...sortedRows);

    table.querySelectorAll("th").forEach(th => th.classList.remove("th-sort-asc", "th-sort-desc"));
    table.querySelector(`th:nth-child(${column + 1})`).classList.toggle("th-sort-asc", asc);
    table.querySelector(`th:nth-child(${column + 1})`).classList.toggle("th-sort-desc", !asc);
}


