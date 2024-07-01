import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
   async toggle() {
      if (this.element.style.width !== 'auto' && this.element.style.width !== '') {
         this.element.style.width = 'auto';
         this.element.children[0].children[0].style.transform = 'rotate(0deg)';
      } else {
         this.element.style.width = '1.8rem';
         this.element.children[0].children[0].style.transform = 'rotate(180deg)';
      }
      await this.#waitForAnimation();
   };

   async close() {
      this.element.style.width = '1.8rem';
      await this.#waitForAnimation();
      this.element.remove();
   }

   #waitForAnimation() {
      return Promise.all(
         this.element.getAnimations().map((animation => animation.finished),)
      )
   }
}
