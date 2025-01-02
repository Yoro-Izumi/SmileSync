document.addEventListener('DOMContentLoaded', function () {
    // Modal Elements
    const modals = {
        viewDetailsModal: document.getElementById('viewItemModal'),
        deleteProgressModal: document.getElementById('deleteProgressModal'),
        addItemModal: document.getElementById('addModal'),
        editModal: document.getElementById('editModal'),
        confirmEditModal: document.getElementById('confirmEditModal'),
        deleteInventoryModal: document.getElementById('removeItemModal'),
        deleteInventoryModalSolo: document.getElementById('removeItemModalSolo')
    };

    // Button Elements
    const buttons = {
        viewDetailsBtn: document.getElementById('viewDetails'),
        viewDetailsHistoryBtn: document.getElementById('viewDetailsHistory'),
        okViewBtn: document.getElementById('okView'),
        addProductBtn: document.getElementById('addProduct'),
        addItemBtn: document.getElementById('addItemBtn'),
        cancelAddItemBtn: document.getElementById('cancelAddItemBtn'),
        deleteProgressBtn: document.getElementById('deleteNewProgressBtn'),
        cancelDeleteProgressBtn: document.getElementById('cancelNewDeleteBtn'),
        editProductBtn: document.getElementById('editProduct'),
        editBtn: document.getElementById('EditBtn'),
        cancelEditBtn: document.getElementById('cancelEditItemBtn'),
        confirmEditBtn: document.getElementById('confirmEditBtn'),
        cancelConfirmEditBtn: document.getElementById('cancelConfirmEditBtn'),
        removeItemTableBtn: document.getElementById('removeProductTable'),
        deleteInventoryBtn: document.getElementById('removeProduct'),
        removeItemBtn: document.getElementById('removeItemBtn'),
        cancelDeleteInventoryBtn: document.getElementById('cancelRemoveItemBtn'),
        removeItemBtnSolo: document.getElementById('removeItemBtnSolo'),
        cancelDeleteInventoryBtnSolo: document.getElementById('cancelRemoveItemBtnSolo'),
        exportExcel: document.getElementById('exportExcel'),
        exportPDF: document.getElementById('exportPDF'),
        exportWord: document.getElementById('exportWord')
    };

    // Function to apply bubble design to text
    const bubbleDesignStyles = `
        .bubble {
            border-radius: 12px;
            background: #f2f2f2;
            padding: 8px 16px;
            margin: 5px;
            display: inline-block;
            font-size: 14px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
        }
    `;

    const applyBubbleDesign = (data) => {
        return `<span class="bubble">${data}</span>`;
    };

    // Reusable function to open and close modals
    const toggleModal = (modalId, action = 'open') => {
        const modal = modals[modalId];
        if (action === 'open') {
            modal.classList.add('show');
        } else {
            modal.classList.remove('show');
        }
    };

    // Modal open and close functionality (using toggleModal)
    buttons.viewDetailsBtn.addEventListener('click', () => toggleModal('viewDetailsModal', 'open'));
    buttons.viewDetailsHistoryBtn.addEventListener('click', () => toggleModal('viewDetailsModal', 'open'));
    buttons.okViewBtn.addEventListener('click', () => toggleModal('viewDetailsModal', 'close'));

    buttons.addProductBtn.addEventListener('click', () => toggleModal('addItemModal', 'open'));
    buttons.addItemBtn.addEventListener('click', () => toggleModal('addItemModal', 'close'));

    buttons.cancelAddItemBtn.addEventListener('click', () => toggleModal('deleteProgressModal', 'open'));
    buttons.cancelDeleteProgressBtn.addEventListener('click', () => toggleModal('deleteProgressModal', 'close'));
    buttons.deleteProgressBtn.addEventListener('click', () => {
        toggleModal('deleteProgressModal', 'close');
        toggleModal('addItemModal', 'close');
    });

    buttons.editProductBtn.addEventListener('click', () => {
        toggleModal('viewDetailsModal', 'close');
        toggleModal('editModal', 'open');
    });
    buttons.cancelEditBtn.addEventListener('click', () => toggleModal('editModal', 'close'));

    buttons.editBtn.addEventListener('click', () => toggleModal('confirmEditModal', 'open'));
    buttons.confirmEditBtn.addEventListener('click', () => {
        toggleModal('confirmEditModal', 'close');
        toggleModal('editModal', 'close');
    });
    buttons.cancelConfirmEditBtn.addEventListener('click', () => toggleModal('confirmEditModal', 'close'));

    buttons.removeItemTableBtn.addEventListener('click', () => toggleModal('deleteInventoryModal', 'open'));
    buttons.deleteInventoryBtn.addEventListener('click', () => toggleModal('deleteInventoryModal', 'open'));
    buttons.cancelDeleteInventoryBtn.addEventListener('click', () => toggleModal('deleteInventoryModal', 'close'));
    buttons.removeItemBtn.addEventListener('click', () => toggleModal('deleteInventoryModal', 'close'));

    buttons.removeItemBtnSolo.addEventListener('click', () => toggleModal('deleteInventoryModalSolo', 'close'));
    buttons.cancelDeleteInventoryBtnSolo.addEventListener('click', () => toggleModal('deleteInventoryModalSolo', 'close'));

    // Reusable Export Functionality
    const exportToFile = (type) => {
        const productTable = document.querySelector('table');

        if (type === 'excel') {
            const wb = XLSX.utils.table_to_book(productTable, { sheet: "Product Overview" });
            const wbout = XLSX.write(wb, { bookType: "xlsx", type: "array" });
            const blob = new Blob([wbout], { type: "application/octet-stream" });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = "product_overview.xlsx";
            link.click();
        } else if (type === 'pdf') {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            doc.autoTable({ html: productTable });
            doc.save('product_overview.pdf');
        } else if (type === 'word') {
            const pptx = new PptxGenJS();
            const slide = pptx.addSlide();
            const rows = Array.from(productTable.rows);
            const tableData = rows.map(row => {
                const cells = Array.from(row.cells).map(cell => applyBubbleDesign(cell.innerText));
                return cells;
            });
            slide.addTable(tableData, { x: 1, y: 1, w: '90%', h: '80%' });
            pptx.save("product_overview");
        }
    };

    // Export Button Event Listeners (all use reusable export function)
    buttons.exportExcel.addEventListener('click', () => exportToFile('excel'));
    buttons.exportPDF.addEventListener('click', () => exportToFile('pdf'));
    buttons.exportWord.addEventListener('click', () => exportToFile('word'));

    // Optional: Add the bubble design styles to the page
    const style = document.createElement('style');
    style.innerHTML = bubbleDesignStyles;
    document.head.appendChild(style);
});
