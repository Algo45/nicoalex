console.log("coucou");
var items = {
    simple: {
        skin: "M4A1-S | Cyrex",
        img: "https://steamcdn-a.akamaihd.net/apps/730/icons/econ/default_generated/weapon_m4a1_silencer_cu_m4a1s_cyrex_light_large.144b4053eb73b4a47f8128ebb0e808d8e28f5b9c.png"
    },
    middle: {
        skin: "M4A1-S | Chantico's Fire",
        img: "https://steamcommunity-a.akamaihd.net/economy/image/-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpou-6kejhz2v_Nfz5H_uO1gb-Gw_alIITCmX5d_MR6j_v--YXygED6_UZrMTzwJYSdJlU8N1zY81TrxO_v0MW9uJnBm3Rk7nEk5XfUmEeyhQYMMLIUhCYx0A"
    },
    super: {
        skin: "M4A4 | Asiimov",
        img: "https://steamcdn-a.akamaihd.net/apps/730/icons/econ/default_generated/weapon_m4a1_cu_m4_asimov_light_large.af03179f3d43ff55b0c3d114c537eac77abdb6cf.png"
    }
};

function generate(ng) {
    document.querySelector('.raffle-roller-container').style.transition = "sdf";
    document.querySelector('.raffle-roller-container').style.marginLeft = "0px";
    document.querySelector('.raffle-roller-container').innerHTML = '';

    var randed2 = prompt('enter skin(1-asiimov,3-cyrex,2-chantico)', '');

    for (var i = 0; i < 101; i++) {
        var element = document.createElement('div');
        element.id = 'CardNumber' + i;
        element.className = 'item class_red_item';
        element.style.backgroundImage = 'url(' + items.simple.img + ')';

        var randed = randomInt(1, 1000);

        if (randed < 50) {
            element.style.backgroundImage = 'url(' + items.super.img + ')';
        } else if (500 < randed) {
            element.style.backgroundImage = 'url(' + items.middle.img + ')';
        }

        document.querySelector('.raffle-roller-container').appendChild(element);
    }
    //RNG a config
    setTimeout(function () {
        if (randed2 == 2) {
            goRoll(items.middle.skin, items.middle.img);
        } else if (randed2 == 1) {
            goRoll(items.super.skin, items.super.img);
        } else {
            goRoll(items.simple.skin, items.simple.img);
        }
    }, 500);
}

function goRoll(skin, skinimg) {
    document.querySelector('.raffle-roller-container').style.transition = "all 8s cubic-bezier(.08,.6,0,1)";
    document.getElementById('CardNumber78').style.backgroundImage = "url(" + skinimg + ")";

    setTimeout(function () {
        document.getElementById('CardNumber78').classList.add('winning-item');
        document.getElementById('rolled').innerHTML = skin;

        var winElement = document.createElement('div');
        winElement.className = 'item class_red_item';
        winElement.style.backgroundImage = 'url(' + skinimg + ')';
        document.querySelector('.inventory').appendChild(winElement);
    }, 8500);

    document.querySelector('.raffle-roller-container').style.marginLeft = '-6770px';
}

function randomInt(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}

