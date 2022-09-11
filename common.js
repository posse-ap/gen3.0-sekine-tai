'use strict';

{
  const Header = document.getElementById('js-header');
  const menu = document.getElementById ('js-menu');
  const HeaderButton = document.getElementById('js-headerButton');
  const bannar = document.getElementById('bannar');

  HeaderButton.addEventListener('click', () => {
    Header.classList.toggle('is-open')
    HeaderButton.classList.toggle('clicked')
    menu.classList.toggle('is-picked')
    bannar.classList.toggle('opened')
  })
}