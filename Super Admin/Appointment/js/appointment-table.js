document.addEventListener("DOMContentLoaded", function () {
    const statusDropdown = document.getElementById("status");
    const searchBar = document.querySelector(".search-bar input");
    const rows = document.querySelectorAll("tbody tr");
    const paginationContainer = document.querySelector(".pagination");
    const rowsPerPage = 5; // Number of rows per page
    let currentPage = 1;

    // Filter rows based on status and search
    function filterRows() {
        const selectedStatus = statusDropdown.value.toLowerCase();
        const searchTerm = searchBar.value.toLowerCase();

        rows.forEach((row) => {
            const statusCell = row.children[5]; // Adjust index for the "Status" column
            const status = statusCell ? statusCell.textContent.trim().toLowerCase() : "";
            const rowText = row.textContent.toLowerCase();

            // Show all rows if "All" is selected; otherwise, match status and search
            const matchesStatus = selectedStatus === "all" || status === selectedStatus;
            const matchesSearch = rowText.includes(searchTerm);

            if (matchesStatus && matchesSearch) {
                row.classList.remove("hidden");
            } else {
                row.classList.add("hidden");
            }
        });

        updatePagination();
    }

    // Update pagination and show rows for the current page
    function updatePagination() {
        const visibleRows = Array.from(rows).filter((row) => !row.classList.contains("hidden"));
        const totalPages = Math.ceil(visibleRows.length / rowsPerPage);
        currentPage = Math.min(currentPage, totalPages || 1); // Ensure currentPage is valid

        renderPagination(totalPages);
        showPage(visibleRows, currentPage);
    }

    // Render pagination buttons
    function renderPagination(totalPages) {
        paginationContainer.innerHTML = ""; // Clear existing buttons

        if (totalPages > 1) {
            const prevButton = document.createElement("a");
            prevButton.href = "#";
            prevButton.classList.add("previous");
            prevButton.textContent = "Previous";
            prevButton.addEventListener("click", (e) => {
                e.preventDefault();
                changePage(currentPage - 1);
            });
            paginationContainer.appendChild(prevButton);

            for (let i = 1; i <= totalPages; i++) {
                const pageButton = document.createElement("a");
                pageButton.href = "#";
                pageButton.classList.add("pagination-item");
                if (i === currentPage) pageButton.classList.add("active");
                pageButton.textContent = i;
                pageButton.addEventListener("click", (e) => {
                    e.preventDefault();
                    changePage(i);
                });
                paginationContainer.appendChild(pageButton);
            }

            const nextButton = document.createElement("a");
            nextButton.href = "#";
            nextButton.classList.add("next");
            nextButton.textContent = "Next";
            nextButton.addEventListener("click", (e) => {
                e.preventDefault();
                changePage(currentPage + 1);
            });
            paginationContainer.appendChild(nextButton);
        }
    }

    // Show rows for the current page
    function showPage(visibleRows, page) {
        visibleRows.forEach((row, index) => {
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            if (index >= start && index < end) {
                row.classList.remove("hidden");
            } else {
                row.classList.add("hidden");
            }
        });
    }

    // Change to a specific page
    function changePage(page) {
        const visibleRows = Array.from(rows).filter((row) => !row.classList.contains("hidden"));
        const totalPages = Math.ceil(visibleRows.length / rowsPerPage);

        if (page < 1 || page > totalPages) return; // Prevent invalid page navigation

        currentPage = page;
        renderPagination(totalPages);
        showPage(visibleRows, currentPage);
    }

    // Event listeners
    statusDropdown.addEventListener("change", filterRows);
    searchBar.addEventListener("input", filterRows);

    // Initial setup
    filterRows(); // Trigger filtering and pagination initially
});