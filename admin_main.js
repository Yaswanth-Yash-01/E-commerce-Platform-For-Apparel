
function showContent(sectionId) {
 
    var contentSections = document.querySelectorAll('.content > div');
    contentSections.forEach(function(section) {
        section.style.display = 'none';
    });

   
    var selectedSection = document.getElementById(sectionId);
    if (selectedSection) {
        selectedSection.style.display = 'block';
    }
}