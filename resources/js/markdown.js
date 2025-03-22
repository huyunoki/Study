import EasyMDE from "easymde";
import "easymde/dist/easymde.min.css";

const easyMDE = new EasyMDE({
    element: document.getElementById('body'),
    sideBySideFullscreen: false,
    spellChecker: false, 
});