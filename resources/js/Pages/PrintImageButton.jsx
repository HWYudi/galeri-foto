import React from 'react';
import { jsPDF } from 'jspdf';

const PrintImageButton = ({ imageUrl }) => {
  const printImageToPDF = () => {
    const doc = new jsPDF();

    // Create an image element to get the dimensions
    const img = new Image();
    img.src = imageUrl;

    img.onload = () => {
      // Calculate dimensions to fit the image on the page
      const pageWidth = doc.internal.pageSize.getWidth();
      const pageHeight = doc.internal.pageSize.getHeight();

      let imgWidth = img.width;
      let imgHeight = img.height;

      if (imgWidth > pageWidth) {
        const ratio = pageWidth / imgWidth;
        imgWidth = pageWidth;
        imgHeight = imgHeight * ratio;
      }

      if (imgHeight > pageHeight) {
        const ratio = pageHeight / imgHeight;
        imgHeight = pageHeight;
        imgWidth = imgWidth * ratio;
      }

      // Calculate position to center the image
      const x = (pageWidth - imgWidth) / 2;
      const y = (pageHeight - imgHeight) / 2;

      // Add the image to the PDF
      doc.addImage(imageUrl, 'JPEG', x, y, imgWidth, imgHeight);

      // Save the PDF
      doc.save('printed_image.pdf');
    };
  };

  return (
    <button
      className="w-full flex items-center gap-2 px-4 py-2 text-sm hover:bg-[#222222]"
      onClick={printImageToPDF}
    >
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
  <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
  <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
</svg>
      Print Gambar
    </button>
  );
};

export default PrintImageButton;
