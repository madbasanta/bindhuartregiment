const object = document.getElementById("blobby")
document.body.onpointermove = event =>{
    const { clientX, pageY } = event

    // object.style.left = `${clientX}px`;
    // object.style.top = `${clientY}px`;
  object.animate({
    left : `${clientX}px`,
    top : `${pageY}px`
  },{duration : 3000,fill: "forwards"});

}
