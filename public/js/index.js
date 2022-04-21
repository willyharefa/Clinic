
new TypeIt("#typing-headline", {
    loop: true,
})
    .type("Pelayanan Cepat", {delay:1200, speed:50})
    .delete(null, {speed:170})
    .type("Pelayanan Nyaman", {delay:1600, speed:50})
    .delete(null, {speed:170})
    .type("Pelayanan Terjangkau", {delay:1200, speed:50})
    .delete(null, {speed:170})
.go();