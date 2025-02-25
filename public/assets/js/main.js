document.querySelectorAll(".mainSec .secBody .content .todoBox .todoFooter").forEach(footers => {
    let todoFooterImageLeft = 0;
    footers.querySelectorAll("img").forEach(image => {
        image.style.left = `${todoFooterImageLeft}rem`;
        todoFooterImageLeft += 3;
    });
});
