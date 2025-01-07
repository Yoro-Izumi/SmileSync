function refreshTable(selector) {
    const table = document.querySelector(selector); // Use a new variable name
    if (!table) {
      console.error(`Table with selector "${selector}" not found.`);
      return;
    }
    const parent = table.parentNode;
  
    // Remove the table and re-append it to the DOM
    parent.removeChild(table);
    parent.appendChild(table);
  }
  
  // Refresh table every second (1000 milliseconds)
  setInterval(() => refreshTable("#myTable"), 1000);
  