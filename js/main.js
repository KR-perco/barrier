'use strict';
(() => {

    //window.addEventListener('load', () => {
    let ArrowsAnimationInited = false;
    window.scrollToElement = null;

    (new IntersectionObserver(e => {
        if (!e[0].isIntersecting || ArrowsAnimationInited) return;
        ArrowsAnimationInited = true;
        startSceneAnimation();
    }, {
        threshold: .9375
    })).observe(document.querySelector('.scene'));

    (new IntersectionObserver(e => {
        if (!e[0].isIntersecting) return;
        if (window.innerWidth < 992) {
            let interval = 0;
            document.querySelectorAll('.menu-btn').forEach(btn => {
                setTimeout(() => {
                    btn.querySelector('.menu-btn__icon').style.transform = 'scale(1)';
                    btn.querySelector('.menu-btn__text').style.transform = 'translate(0, 0)';
                    btn.querySelector('.menu-btn__text').style.opacity = '1';
                }, interval);
                interval += 200;
            });
            return;
        }
        document.querySelector('.menu-block__btns').style.backgroundSize = '100% 100%';
        document.querySelector('.menu-block__btns').addEventListener('transitionend', () => {
            let interval = 0;
            document.querySelectorAll('.menu-btn').forEach(btn => {
                setTimeout(() => {
                    btn.querySelector('.menu-btn__icon').style.transform = 'scale(1)';
                    btn.querySelector('.menu-btn__text').style.transform = 'translate(0, 0)';
                    btn.querySelector('.menu-btn__text').style.opacity = '1';
                }, interval);
                interval += 200;
            });
        });
    }, {
        threshold: .5
    })).observe(document.querySelector('.menu-block'));

    document.querySelectorAll('.use-icon__icon').forEach(icon => {
        (new IntersectionObserver(e => {
            if (!e[0].isIntersecting) return;
            e[0].target.querySelector('.use-icon__img').style.transform = 'none';
            e[0].target.querySelector('.use-icon__img').style.opacity = '1';
        }, {
            threshold: .9
        })).observe(icon);
    });

    document.querySelectorAll('.use-icon__text').forEach(icon => {
        (new IntersectionObserver(e => {
            if (!e[0].isIntersecting) return;
            e[0].target.style.transform = 'none';
            e[0].target.style.opacity = '1';
        }, {
            rootMargin: '-32px'
        })).observe(icon);
    });

    document.querySelectorAll('.set-block-photo__photo').forEach(icon => {
        (new IntersectionObserver(e => {
            if (!e[0].isIntersecting) return;
            e[0].target.querySelector('.set-block-photo__img').style.transform = 'none';
            e[0].target.querySelector('.set-block-photo__img').style.opacity = '1';
        }, {
            threshold: .9
        })).observe(icon);
    });

    document.querySelectorAll('.set-block-photo__text').forEach(icon => {
        (new IntersectionObserver(e => {
            if (!e[0].isIntersecting) return;
            e[0].target.style.transform = 'none';
            e[0].target.style.opacity = '1';
        }, {
            rootMargin: '-64px'
        })).observe(icon);
    });

    document.querySelectorAll('.optional-block-photo__photo').forEach(icon => {
        (new IntersectionObserver(e => {
            if (!e[0].isIntersecting) return;
            e[0].target.querySelector('.optional-block-photo__img').style.transform = 'none';
            e[0].target.querySelector('.optional-block-photo__img').style.opacity = '1';
        }, {
            threshold: .9
        })).observe(icon);
    });

    document.querySelectorAll('.optional-block-photo__text').forEach(icon => {
        (new IntersectionObserver(e => {
            if (!e[0].isIntersecting) return;
            e[0].target.style.transform = 'none';
            e[0].target.style.opacity = '1';
        }, {
            rootMargin: '-32px'
        })).observe(icon);
    });

    document.querySelectorAll('.control-block__icons').forEach(icons => {
        (new IntersectionObserver(e => {
            if (!e[0].isIntersecting || window.innerWidth < 768) return;
            let interval = 0;
            document.querySelectorAll('.control-icon').forEach(icon => {
                setTimeout(() => {
                    icon.querySelector('.control-icon__title').style.opacity = 1;
                    icon.querySelector('.control-icon__img').style.transform = 'none';
                }, interval);
                interval += 100;
            });
        }, {
            threshold: .5
        })).observe(icons);
    });

    document.querySelectorAll('.control-icon').forEach(icon => {
        (new IntersectionObserver(e => {
            if (!e[0].isIntersecting || window.innerWidth > 768) return;
            e[0].target.querySelector('.control-icon__title').style.opacity = 1;
            e[0].target.querySelector('.control-icon__img').style.transform = 'none';
        }, {
            threshold: .5
        })).observe(icon);
    });

    document.querySelectorAll('.features-block__icons').forEach(icon => {
        (new IntersectionObserver(e => {
            if (!e[0].isIntersecting || window.innerWidth < 992) return;
            let interval = 0;
            document.querySelectorAll('.feature-icon').forEach(icon => {
                setTimeout(() => {
                    icon.querySelector('.feature-icon__img').style.transform = 'none';
                    icon.querySelector('.feature-icon__text').style.opacity = 1;
                }, interval);
                interval += 100;
            });
        }, {
            threshold: .5
        })).observe(icon);
    });

    document.querySelectorAll('.feature-icon').forEach(icon => {
        (new IntersectionObserver(e => {
            if (!e[0].isIntersecting || window.innerWidth > 992) return;
            e[0].target.querySelector('.feature-icon__img').style.transform = 'none';
            e[0].target.querySelector('.feature-icon__text').style.opacity = 1;
        }, {
            threshold: .5
        })).observe(icon);
    });

    document.querySelectorAll('.characteristics-block__top').forEach(top => {
        (new IntersectionObserver(e => {
            if (!e[0].isIntersecting) return;
            let interval = 0;
            document.querySelectorAll('.characteristics-icon').forEach(icon => {
                setTimeout(() => {
                    icon.querySelector('.characteristics-icon__img').style.transform = 'none';
                    icon.querySelector('.characteristics-icon__title').style.opacity = 1;
                }, interval);
                interval += 100;
            });
        }, {
            threshold: .5
        })).observe(top);
    });

    document.querySelectorAll('.characteristics-block__bottom').forEach(bottom => {
        (new IntersectionObserver(e => {
            if (window.innerWidth < 992) return;
            let offset = 0;
            if (window.innerWidth < 1200) {
                offset = 48;
            } else if (window.innerWidth < 1460) {
                offset = 64;
            } else {
                offset = 128;
            }
            if (document.querySelector('.characteristics-picture__img_schema').computedStyleMap) {
                if (e[0].intersectionRatio * offset - offset < document.querySelector('.characteristics-picture__img_schema').computedStyleMap().get('transform')[0].x.value) return;
            } else {
                if (e[0].intersectionRatio * offset - offset < Number(getComputedStyle(document.querySelector('.characteristics-picture__img_schema')).getPropertyValue('transform').replace(/^matrix\((\d*, ){4}/, '').replace(/, \d*\)$/, ''))) return;
            }
            if (e[0].intersectionRatio * offset - offset > 0) {
                document.querySelector('.characteristics-picture__img_schema').style.transform = `translate(0, 0)`;
                document.querySelector('.characteristics-picture__img_schema').style.opacity = 1;
                document.querySelector('.characteristics-picture__img_description').style.transform = `translate(0, 0)`;
                document.querySelector('.characteristics-picture__img_description').style.opacity = 1;
                document.querySelector('.characteristics-picture__title_schema').style.transform = `translate(0, 0)`;
                document.querySelector('.characteristics-picture__title_schema').style.opacity = 1;
                document.querySelector('.characteristics-picture__title_description').style.transform = `translate(0, 0)`;
                document.querySelector('.characteristics-picture__title_description').style.opacity = 1;
            } else {
                document.querySelector('.characteristics-picture__img_schema').style.transform = `translate(${e[0].intersectionRatio * offset - offset}px, 0)`;
                document.querySelector('.characteristics-picture__img_schema').style.opacity = e[0].intersectionRatio;
                document.querySelector('.characteristics-picture__img_description').style.transform = `translate(${offset - e[0].intersectionRatio * offset}px, 0)`;
                document.querySelector('.characteristics-picture__img_description').style.opacity = e[0].intersectionRatio;
            }
            if (e[0].intersectionRatio > .9) {
                document.querySelector('.characteristics-picture__title_schema').style.transform = `translate(${(e[0].intersectionRatio - .9) / .1 * offset - offset}px, 0)`;
                document.querySelector('.characteristics-picture__title_schema').style.opacity = (e[0].intersectionRatio - .9) / .1;
                document.querySelector('.characteristics-picture__title_description').style.transform = `translate(${offset - (e[0].intersectionRatio - .9) / .1 * offset}px, 0)`;
                document.querySelector('.characteristics-picture__title_description').style.opacity = (e[0].intersectionRatio - .9) / .1;
            }
        }, {
            threshold: Array.from(Array(100).keys(), x => x / 100)
        })).observe(bottom);
    });

    document.querySelectorAll('.characteristics-picture__img').forEach(img => {
        (new IntersectionObserver(e => {
            if (!e[0].isIntersecting) return;
            e[0].target.style.opacity = 1;
        }, {
            threshold: .9
        })).observe(img);
    });

    document.querySelectorAll('.characteristics-picture__title').forEach(title => {
        (new IntersectionObserver(e => {
            if (!e[0].isIntersecting) return;
            e[0].target.style.opacity = 1;
        }, {
            threshold: .9
        })).observe(title);
    });

    document.querySelectorAll('.file').forEach(icon => {
        (new IntersectionObserver(e => {
            if (!e[0].isIntersecting) return;
            e[0].target.style.transform = 'none';
            e[0].target.style.opacity = '1';
        }, {
            threshold: 1
        })).observe(icon);
    });

    document.querySelectorAll('.solutions-block__paragraph').forEach(paragraph => {
        (new IntersectionObserver(e => {
            if (!e[0].isIntersecting) return;
            e[0].target.style.transform = 'none';
            e[0].target.style.opacity = '1';
        }, {
            threshold: .9
        })).observe(paragraph);
    });

    document.querySelectorAll('.solutions-block__subtitle').forEach(paragraph => {
        (new IntersectionObserver(e => {
            if (!e[0].isIntersecting) return;
            e[0].target.style.opacity = '1';
        }, {
            threshold: .9
        })).observe(paragraph);
    });

    document.querySelectorAll('.solution-text-block').forEach(textBlock => {
        (new IntersectionObserver(e => {
            if (!e[0].isIntersecting || window.innerWidth < 992) return;
            e[0].target.querySelector('.solution-text-block__text').style.transform = 'none';
            e[0].target.querySelector('.solution-text-block__text').style.opacity = '1';
            setTimeout(() => {
                e[0].target.querySelector('.solution-text-block__img').style.transform = 'none';
                e[0].target.querySelector('.solution-text-block__img').style.opacity = 1;
            }, 200);
        }, {
            threshold: .5
        })).observe(textBlock);
    });

    document.querySelectorAll('.solution-text-block__text').forEach(text => {
        (new IntersectionObserver(e => {
            if (!e[0].isIntersecting || window.innerWidth >= 992) return;
            e[0].target.style.transform = 'none';
            e[0].target.style.opacity = '1';
        }, {
            threshold: .25
        })).observe(text);
    });

    document.querySelectorAll('.solution-text-block__img').forEach(img => {
        (new IntersectionObserver(e => {
            if (!e[0].isIntersecting || window.innerWidth >= 992) return;
            e[0].target.style.transform = 'none';
            e[0].target.style.opacity = '1';
        }, {
            threshold: .25
        })).observe(img);
    });

    (new IntersectionObserver(e => {
        if (!e[0].isIntersecting) return;
        let script = document.createElement('script');
        script.src = 'https://www.google.com/recaptcha/api.js';
        document.getElementsByTagName('head')[0].appendChild(script);
    })).observe(document.querySelector('.about-block'));

    document.querySelectorAll('.about-block__icons').forEach(icon => {
        (new IntersectionObserver(e => {
            if (!e[0].isIntersecting || window.innerWidth < 768) return;
            let interval = 0;
            document.querySelectorAll('.about-icon').forEach(icon => {
                setTimeout(() => {
                    icon.style.transform = 'none';
                    icon.style.opacity = 1;
                    //if (icon?.nextElementSibling?.nextElementSibling?.nextElementSibling) {
                    if (icon.nextElementSibling && icon.nextElementSibling.nextElementSibling && icon.nextElementSibling.nextElementSibling.nextElementSibling) {
                        icon.nextElementSibling.nextElementSibling.nextElementSibling.style.transform = 'none';
                        icon.nextElementSibling.nextElementSibling.nextElementSibling.style.opacity = 1;
                    }
                }, interval);
                interval += 200;
            });
        }, {
            threshold: .5
        })).observe(icon);
    });

    document.querySelectorAll('.about-icon').forEach(icon => {
        (new IntersectionObserver(e => {
            if (!e[0].isIntersecting || window.innerWidth >= 768) return;
            e[0].target.style.transform = 'none';
            e[0].target.style.opacity = '1';
        }, {
            threshold: .5
        })).observe(icon);
    });

    document.querySelectorAll('.about-photo__img').forEach(img => {
        (new IntersectionObserver(e => {
            if (!e[0].isIntersecting) return;
            e[0].target.style.opacity = 1;
        }, {
            threshold: .5
        })).observe(img);
    });

    window.addEventListener('click', () => {
        if (!document.querySelector('.optional-block-photo__description[data-state="opened"]')) return;
        document.querySelectorAll('.optional-block-photo__description[data-state="opened"]').forEach(desc => {
            if (window.innerWidth < 576) {
                desc.style.transform = `translate(${-Number(desc.closest('.optional-block-photo').getBoundingClientRect().left) + 14}px, 32px)`;
            } else if (window.innerWidth < 992) {
                let i = 1;
                let index = 0;
                document.querySelectorAll('.optional-block-photo').forEach(photo => {
                    if (photo == desc.closest('.optional-block-photo')) {
                        index = i;
                    }
                    i++;
                });
                if (index % 2 == 0) {
                    desc.style.transform = `translate(-258px, 32px)`;
                } else {
                    desc.style.transform = `translate(0, 32px)`;
                }
            } else if (window.innerWidth < 1200) {
                let i = 1;
                let index = 0;
                document.querySelectorAll('.optional-block-photo').forEach(photo => {
                    if (photo == desc.closest('.optional-block-photo')) {
                        index = i;
                    }
                    i++;
                });
                if ((index + 2) % 3 == 0) {
                    desc.style.transform = `translate(0, 32px)`;
                } else if ((index + 1) % 3 == 0) {
                    desc.style.transform = `translate(-129px, 32px)`;
                } else if (index % 3 == 0) {
                    desc.style.transform = `translate(-258px, 32px)`;
                }
            } else {
                let i = 1;
                let index = 0;
                document.querySelectorAll('.optional-block-photo').forEach(photo => {
                    if (photo == desc.closest('.optional-block-photo')) {
                        index = i;
                    }
                    i++;
                });
                if ((index + 3) % 4 == 0) {
                    desc.style.transform = `translate(0, 32px)`;
                } else if ((index + 1) % 4 == 0 || (index + 2) % 4 == 0) {
                    desc.style.transform = `translate(-129px, 32px)`;
                } else if (index % 4 == 0) {
                    desc.style.transform = `translate(-258px, 32px)`;
                }
            }

            desc.style.opacity = 0;
            desc.addEventListener('transitionend', () => {
                desc.style.display = '';
                desc.dataset.state = 'closed';
            }, {
                once: true
            });
            document.querySelectorAll('.optional-block-photo__img, .optional-block-photo__text').forEach(elem => {
                elem.style.cursor = '';
            });
        });
    });

    document.querySelectorAll('.optional-block-photo__description').forEach(desc => {
        desc.addEventListener('click', e => {
            e.stopPropagation();
        });
    });

    window.addEventListener('resize', () => {
        document.querySelector('.solutions-block__head').style.blockSize = `${window.innerWidth / Number(document.querySelector('.solutions-block__head').dataset.ratio)}px`;
        document.querySelector('.about-head__img').style.blockSize = `${window.innerWidth / Number(document.querySelector('.about-head__img').dataset.ratio)}px`;
        if (window.innerWidth < 498) {
            document.querySelector('.characteristics-picture__img_schema').style.blockSize = `${document.querySelector('.characteristics-picture__img_schema').getBoundingClientRect().width / document.querySelector('.characteristics-picture__img_schema').dataset.ratio}px`;
        } else {
            document.querySelector('.characteristics-picture__img_schema').style.blockSize = '';
        }
        if (window.innerWidth < 598) {
            document.querySelector('.characteristics-picture__img_description').style.blockSize = `${window.innerWidth - 28}px`;
        } else {
            document.querySelector('.characteristics-picture__img_description').style.blockSize = '';
        }
        if (window.innerWidth < 528) {
            document.querySelectorAll('.solution-text-block__img').forEach(img => {
                img.style.blockSize = `${(window.innerWidth - 28) / img.dataset.ratio}px`;
            });
        } else {
            document.querySelectorAll('.solution-text-block__img').forEach(img => {
                img.style.blockSize = '';
            });
        }
        let secondScreenVideosWidth = 320;
        let secondScreenVideosHeight = 240;
        if (window.innerWidth > 320) {
            secondScreenVideosWidth = 640;
            secondScreenVideosHeight = 480;
        }
        if (window.innerWidth > 640) {
            secondScreenVideosWidth = 720;
            secondScreenVideosHeight = 540;
        }
        if (window.innerWidth > 720) {
            secondScreenVideosWidth = 1920;
            secondScreenVideosHeight = 1080;
        }
        document.querySelector('.model-video_folding-arrow').width = secondScreenVideosWidth;
        document.querySelector('.model-video_folding-arrow').height = secondScreenVideosHeight;
        document.querySelector('.model-video_folding-arrow').innerHTML = `
			<source src="video/folding-arrow-${secondScreenVideosWidth}.webm" type="video/webm">
			<source src="video/folding-arrow-${secondScreenVideosWidth}.mp4" type="video/mp4">
			`;
        document.querySelector('.model-video_car-passage').width = secondScreenVideosWidth;
        document.querySelector('.model-video_car-passage').height = secondScreenVideosHeight;
        document.querySelector('.model-video_car-passage').innerHTML = `
			<source src="video/car-passage-${secondScreenVideosWidth}.webm" type="video/webm">
			<source src="video/car-passage-${secondScreenVideosWidth}.mp4" type="video/mp4">
			`;
        document.querySelector('.model-video_control-board').width = secondScreenVideosWidth;
        document.querySelector('.model-video_control-board').height = secondScreenVideosHeight;
        document.querySelector('.model-video_control-board').innerHTML = `
			<source src="video/control-board-${secondScreenVideosWidth}.webm" type="video/webm">
			<source src="video/control-board-${secondScreenVideosWidth}.mp4" type="video/mp4">
			`;
        document.querySelector('.model-video_unlocking').width = secondScreenVideosWidth;
        document.querySelector('.model-video_unlocking').height = secondScreenVideosHeight;
        document.querySelector('.model-video_unlocking').innerHTML = `
			<source src="video/unlocking-${secondScreenVideosWidth}.webm" type="video/webm">
			<source src="video/unlocking-${secondScreenVideosWidth}.mp4" type="video/mp4">
			`;
        if (window.innerWidth < 576) {
            document.querySelectorAll('.optional-block-photo__description').forEach(desc => {
                desc.style.transform = `translate(${-Number(desc.closest('.optional-block-photo').getBoundingClientRect().left) + 14}px, 0)`;
            });
        } else {
            document.querySelectorAll('.optional-block-photo__description').forEach(desc => {
                desc.style.transform = '';
            });
        }
    });

    const initAnimation = () => {
        document.querySelectorAll('.logo, .main-btn_home').forEach(elem => {
            elem.style.opacity = 1;
        });
        document.querySelector('.logo').addEventListener('transitionend', () => {
            document.querySelector('.title').style.opacity = 1;
            document.querySelector('.text-block__title').style.opacity = 1;
            document.querySelector('.header__border').style.transform = 'scale(1)';
        });
        document.querySelector('.header__border').addEventListener('transitionend', () => {
            setTimeout(() => {
                document.querySelectorAll('.big-text-block__img').forEach(img => {
                    img.style.transform = 'scale(1)';
                });
                document.querySelectorAll('.text-block__img').forEach(img => {
                    img.style.transform = 'scale(1)';
                });
                setTimeout(() => {
                    document.querySelector('.big-text-block__text').style.transform = 'translate(0)';
                    document.querySelector('.big-text-block__text').style.opacity = '1';
                    document.querySelector('.text-block__text').style.transform = 'translate(0)';
                    document.querySelector('.text-block__text').style.opacity = '1';
                }, 200);
            }, 100);
        });
        document.querySelectorAll('.text-block__text, .big-text-block__text').forEach(text => {
            text.addEventListener('transitionend', () => {
                document.querySelector('.main-btn_boom_barrier').style.transform = 'scale(1)';
                setTimeout(() => {
                    document.querySelector('.main-btn_menu').style.transform = 'scale(1)';
                }, 100);
            });
        });
        document.querySelector('.main-btn_menu').addEventListener('transitionend', () => {
            document.querySelector('.dop-btn_video').style.transform = 'translate(0)';
            document.querySelector('.dop-btn_video').style.opacity = '1';
            setTimeout(() => {
                document.querySelector('.dop-btn_mail').style.transform = 'translate(0)';
                document.querySelector('.dop-btn_mail').style.opacity = '1';
            }, 100);
        });
    };

    const startSceneAnimation = () => {
        let startTime = null;
        const arrowsAnimation = document.querySelector('.arrows-animation');
        const arrows = document.querySelectorAll('.arrows-animation__img_arrow');
        const stepSceneAnimation = time => {
            if (!startTime) startTime = time;
            const d = time - startTime;
            if (d >= 1500 && d < 2000) {
                let offset = (d - 1500) / 500;
                arrows[0].style.opacity = 1 - offset;
                if (window.innerWidth < 992) {
                    document.querySelector('.arrows-animation__text-block_square-3').style.opacity = 1 - offset;
                }
            } else if (d >= 2000 && d < 2500) {
                let offset = (d - 2000) / 500;
                arrows[0].style.opacity = 0;
                arrows[1].style.opacity = (d - 2000) / 500;
                if (window.innerWidth < 992) {
                    document.querySelector('.arrows-animation__text-block_square-3').style.display = 'none';
                    document.querySelector('.arrows-animation__text-block_square-43').style.display = 'block';
                    document.querySelector('.arrows-animation__text-block_square-3').style.opacity = 0;
                    document.querySelector('.arrows-animation__text-block_square-43').style.opacity = offset;
                } else {
                    document.querySelector('.arrows-animation__title-3').style.transform = `translate(0, ${offset * 24}px)`;
                    document.querySelector('.arrows-animation__title-3').style.opacity = 1 - offset;
                    document.querySelector('.arrows-animation__title-43').style.transform = `translate(503px, ${-24 + offset * 24}px)`;
                    document.querySelector('.arrows-animation__title-43').style.opacity = offset;
                    document.querySelector('.arrows-animation__title-meters').style.transform = `translate(${offset * 21}px, 0)`;

                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-euro').style.transform = `translate(0, ${-offset * 16}px)`;
                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-euro').style.opacity = 1 - offset;
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-euro').style.transform = `translate(329px, ${16 - offset * 16}px)`;
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-euro').style.opacity = offset;
                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-ruble').style.transform = `translate(0, ${-offset * 16}px)`;
                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-ruble').style.opacity = 1 - offset;
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-ruble').style.transform = `translate(0, ${37 - offset * 16}px)`;
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-ruble').style.opacity = offset;
                }
            } else if (d >= 2500 && d < 4000) {
                arrows[1].style.opacity = 1;
                if (window.innerWidth < 992) {
                    document.querySelector('.arrows-animation__text-block_square-43').style.opacity = 1;
                } else {
                    document.querySelector('.arrows-animation__title-3').style.transform = 'translate(0, 24px)';
                    document.querySelector('.arrows-animation__title-3').style.opacity = 0;
                    document.querySelector('.arrows-animation__title-43').style.transform = 'translate(503px, 0px)';
                    document.querySelector('.arrows-animation__title-43').style.opacity = 1;
                    document.querySelector('.arrows-animation__title-meters').style.transform = 'translate(21px, 0)';

                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-euro').innerText = `${square43Price} €`;
                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-ruble').innerText = `${square43PriceRubles} ₽`;
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-euro').innerText = `${round43Price} €`;
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-ruble').innerText = `${round43PriceRubles} ₽`;
                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-euro').style.transform = '';
                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-euro').style.opacity = '';
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-euro').style.transform = '';
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-euro').style.opacity = '';
                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-ruble').style.transform = '';
                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-ruble').style.opacity = '';
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-ruble').style.transform = '';
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-ruble').style.opacity = '';
                }
            } else if (d >= 4000 && d < 4500) {
                let offset = (d - 4000) / 500;
                arrows[1].style.opacity = 1 - offset;
                if (window.innerWidth < 992) {
                    document.querySelector('.arrows-animation__text-block_square-43').style.opacity = 1 - offset;
                }
            } else if (d >= 4500 && d < 5000) {
                let offset = (d - 4500) / 500;
                arrows[1].style.opacity = 0;
                arrows[2].style.opacity = offset;
                if (window.innerWidth < 992) {
                    document.querySelector('.arrows-animation__text-block_square-43').style.display = 'none';
                    document.querySelector('.arrows-animation__text-block_round-43').style.display = 'block';
                    document.querySelector('.arrows-animation__text-block_square-43').style.opacity = 0;
                    document.querySelector('.arrows-animation__text-block_round-43').style.opacity = offset;
                } else {
                    document.querySelector('.arrows-animation__title-square').style.transform = `translate(0, ${offset * 24}px)`;
                    document.querySelector('.arrows-animation__title-square').style.opacity = 1 - offset;
                    document.querySelector('.arrows-animation__title-round').style.transform = `translate(237px, ${-24 + offset * 24}px)`;
                    document.querySelector('.arrows-animation__title-round').style.opacity = offset;
                    document.querySelector('.arrows-animation__title-section').style.transform = `translate(${-offset * 77}px, 0)`;
                    document.querySelector('.arrows-animation__title-43').style.transform = `translate(${503 - offset * 77}px, 0)`;
                    document.querySelector('.arrows-animation__title-meters').style.transform = `translate(${21 - offset * 78}px, 0)`;
                    document.querySelector('.arrows-animation__title-3').style.transform = 'translate(-77px, 24px)';

                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-euro').style.transform = `translate(0, ${-offset * 16}px)`;
                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-euro').style.opacity = 1 - offset;
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-euro').style.transform = `translate(329px, ${16 - offset * 16}px)`;
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-euro').style.opacity = offset;
                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-ruble').style.transform = `translate(0, ${-offset * 16}px)`;
                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-ruble').style.opacity = 1 - offset;
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-ruble').style.transform = `translate(0, ${37 - offset * 16}px)`;
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-ruble').style.opacity = offset;
                }
            } else if (d >= 5000 && d < 6500) {
                arrows[2].style.opacity = 1;
                if (window.innerWidth < 992) {
                    document.querySelector('.arrows-animation__text-block_round-43').style.opacity = 1;
                } else {
                    document.querySelector('.arrows-animation__title-square').style.transform = 'translate(0, 24px)';
                    document.querySelector('.arrows-animation__title-square').style.opacity = 0;
                    document.querySelector('.arrows-animation__title-round').style.transform = 'translate(237px, 0)';
                    document.querySelector('.arrows-animation__title-round').style.opacity = 1;
                    document.querySelector('.arrows-animation__title-section').style.transform = 'translate(-77px, 0)';
                    document.querySelector('.arrows-animation__title-43').style.transform = 'translate(426px, 0)';
                    document.querySelector('.arrows-animation__title-meters').style.transform = 'translate(-57px, 0)';

                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-euro').innerText = `${round43Price} €`;
                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-ruble').innerText = `${round43PriceRubles} ₽`;
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-euro').innerText = `${round3Price} €`;
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-ruble').innerText = `${round3PriceRubles} ₽`;
                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-euro').style.transform = '';
                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-euro').style.opacity = '';
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-euro').style.transform = '';
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-euro').style.opacity = '';
                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-ruble').style.transform = '';
                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-ruble').style.opacity = '';
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-ruble').style.transform = '';
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-ruble').style.opacity = '';
                }
            } else if (d >= 6500 && d < 7000) {
                let offset = (d - 6500) / 500;
                arrows[2].style.opacity = 1 - offset;
                if (window.innerWidth < 992) {
                    document.querySelector('.arrows-animation__text-block_round-43').style.opacity = 1 - offset;
                }
            } else if (d >= 7000 && d < 7500) {
                let offset = (d - 7000) / 500;
                arrows[2].style.opacity = 0;
                arrows[3].style.opacity = offset;
                if (window.innerWidth < 992) {
                    document.querySelector('.arrows-animation__text-block_round-43').style.display = 'none';
                    document.querySelector('.arrows-animation__text-block_round-3').style.display = 'block';
                    document.querySelector('.arrows-animation__text-block_round-43').style.opacity = 0;
                    document.querySelector('.arrows-animation__text-block_round-3').style.opacity = offset;
                } else {
                    document.querySelector('.arrows-animation__title-43').style.transform = `translate(426px, ${-offset * 24}px)`;
                    document.querySelector('.arrows-animation__title-43').style.opacity = 1 - offset;
                    document.querySelector('.arrows-animation__title-3').style.transform = `translate(-77px, ${24 - offset * 24}px)`;
                    document.querySelector('.arrows-animation__title-3').style.opacity = offset;
                    document.querySelector('.arrows-animation__title-meters').style.transform = `translate(${-57 - offset * 20}px, 0)`;

                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-euro').style.transform = `translate(0, ${-offset * 16}px)`;
                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-euro').style.opacity = 1 - offset;
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-euro').style.transform = `translate(329px, ${16 - offset * 16}px)`;
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-euro').style.opacity = offset;
                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-ruble').style.transform = `translate(0, ${-offset * 16}px)`;
                    document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-ruble').style.opacity = 1 - offset;
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-ruble').style.transform = `translate(0, ${37 - offset * 16}px)`;
                    document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-ruble').style.opacity = offset;
                }
            } else if (d >= 7500 && d < 9000) {
                arrows[3].style.opacity = 1;
                document.querySelector('.arrows-animation__title-43').style.transform = 'translate(426px, -24px)';
                document.querySelector('.arrows-animation__title-43').style.opacity = 0;
                document.querySelector('.arrows-animation__title-3').style.transform = 'translate(-77px, 0px)';
                document.querySelector('.arrows-animation__title-3').style.opacity = 1;
                document.querySelector('.arrows-animation__title-meters').style.transform = 'translate(-77px, 0)';

                document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-euro').innerText = `${round3Price} €`;
                document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-ruble').innerText = `${round3PriceRubles} ₽`;
                document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-euro').style.transform = '';
                document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-euro').style.opacity = '';
                document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-euro').style.transform = '';
                document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-euro').style.opacity = '';
                document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-ruble').style.transform = '';
                document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-ruble').style.opacity = '';
                document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-ruble').style.transform = '';
                document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-ruble').style.opacity = '';
            } else if (d >= 9000 && d < 9500) {
                arrowsAnimation.style.opacity = 1 - (d - 6500) / 500;
            } else if (d >= 9500) {
                arrowsAnimation.style.opacity = 0;
                document.querySelector('.scene').style.paddingBlockEnd = '0';
                document.querySelector('.scene__animation_active').classList.remove('scene__animation_active');
                document.querySelector('.scene__videos').style.display = 'flex';
                document.querySelector('.model-video:first-child').pause();
                document.querySelector('.model-video:first-child').currentTime = 0;
                document.querySelector('.model-video:first-child').play();
                document.querySelector('.model-video:first-child').classList.add('scene__animation_active');
                document.querySelector('.model-video:first-child').offsetLeft;
                document.querySelector('.model-video:first-child').style.opacity = 1;

                const nextBtn = document.querySelector('.scene-slide-btn_active').closest('.scene-control__cell').nextElementSibling.querySelector('.scene-slide-btn');
                document.querySelector('.scene-slide-btn_active').classList.remove('scene-slide-btn_active');
                nextBtn.classList.add('scene-slide-btn_active');
                console.log(`animation ended`);
                return;
            }
            window.arrowAnimation = requestAnimationFrame(stepSceneAnimation);
        };
        document.querySelectorAll('.arrows-animation__text-block').forEach(text => {
            text.style.display = '';
            text.style.opacity = '';
        });
        document.querySelectorAll('.arrows-animation__img_arrow, .arrows-animation__title-word, .arrows-animation__price-value-number').forEach(elem => {
            elem.style.transform = '';
            elem.style.opacity = '';
        });
        document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-euro').innerText = `${square3Price} €`;
        document.querySelector('.arrows-animation__price-value-number-current.arrows-animation__price-value-number-ruble').innerText = `${square3PriceRubles} ₽`;
        document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-euro').innerText = `${square43Price} €`;
        document.querySelector('.arrows-animation__price-value-number-new.arrows-animation__price-value-number-ruble').innerText = `${square43PriceRubles} ₽`;
        window.arrowAnimation = requestAnimationFrame(time => {
            stepSceneAnimation(time);
        });
    };

    const scrollToModel = () => {
        if (document.querySelector('.model-block').getBoundingClientRect().top != 0) return;
        window.removeEventListener('scroll', scrollToModel);
        document.querySelector('.model-block').style.position = 'fixed';
        document.querySelectorAll('.main>section:not(.model-block), .main>div').forEach(elem => {
            elem.style.display = 'none';
        });
    };

    const loadModel = () => {
        let script = document.createElement('script');
        script.addEventListener('load', () => {
            if (!BABYLON.Engine.isSupported()) {
                console.error('Babylon не поддерживается');
                return;
            }

            const canvas = document.querySelector(`.scene__model`);
            const engine = new BABYLON.Engine(canvas, true);

            engine.enableOfflineSupport = false;
            BABYLON.Animation.AllowMatricesInterpolation = true;

            function modelPreloader() {};
            modelPreloader.prototype.displayLoadingUI = () => {
                document.querySelector('.scene__model-preloader').style.display = 'flex';
            };
            modelPreloader.prototype.hideLoadingUI = () => {
                document.querySelector('.scene__model').dataset.loaded = 'true';
                if (document.querySelector('.scene-big-btn').dataset.state == '3d') {
                    document.querySelector('.scene__model-preloader').style.display = 'none';
                    return;
                }
                document.querySelector('.scene-big-btn').classList.remove('scene-big-btn_disabled');
                document.querySelector('.scene-big-btn__preloader').style.display = 'none';
                document.querySelector('.scene-big-btn__img_3d').style.display = '';
            };
            engine.loadingScreen = new modelPreloader();

            BABYLON.SceneLoader.Load("", "model/boom-barrier.babylon", engine, function(scene) {
                let radius;
                window.scene = scene;

                scene.clearColor = new BABYLON.Color3(.93, .93, .93);
                if (window.innerWidth < 320) {
                    radius = 9;
                } else if (window.innerWidth < 370) {
                    radius = 8;
                } else if (window.innerWidth < 390) {
                    radius = 9;
                } else if (window.innerWidth < 460) {
                    radius = 8;
                } else if (window.innerWidth < 560) {
                    radius = 7;
                } else if (window.innerWidth < 1200) {
                    radius = 6;
                } else if (window.innerWidth < 1460) {
                    radius = 5;
                } else {
                    radius = 4;
                }

                scene.activeCamera = new BABYLON.ArcRotateCamera("Camera", -.5 * Math.PI, .5 * Math.PI, radius, new BABYLON.Vector3(0, 0, 0), scene);
                scene.activeCamera.focusOn(scene.meshes, true);
                scene.activeCamera.minZ = 0;
                scene.activeCamera.pinchPrecision = 96;
                scene.activeCamera.wheelPrecision = 64;
                //scene.activeCamera.useNaturalPinchZoom(true);
                scene.activeCamera.lowerRadiusLimit = 2;
                scene.activeCamera.upperRadiusLimit = radius + 2;
                scene.activeCamera.panningSensibility = 0;
                scene.activeCamera.attachControl(canvas, true);
                scene.activeCamera.useAutoRotationBehavior = true;

                engine.runRenderLoop(() => {
                    scene.render();
                    engine.resize();
                });
            }, (progress) => {
                const percentage = Math.round(progress.loaded / progress.total * Math.pow(10, 2));
                document.querySelector('.scene__model-preloader-text').innerText = `${percentage}%`;
                document.querySelector('.scene-big-btn__preloader-text').innerText = `${percentage}%`;
            });

            window.addEventListener('resize', () => {
                engine.resize();
            });
        }, {
            once: true
        });
        script.src = 'https://cdn.babylonjs.com/babylon.js';
        document.getElementsByTagName('head')[0].appendChild(script);
    };

    const init = async() => {
        if (window.navigator.platform.toLowerCase() == 'macintel' && window.navigator.userAgent.toLowerCase().indexOf('safari') > -1 && window.navigator.userAgent.toLowerCase().indexOf('chrome') == -1) {
            const modelBlock = document.querySelector('.model-block');
            modelBlock.style.display = 'flex';
            modelBlock.style.flexDirection = 'column';
            modelBlock.style.justifyItems = 'flex-start';
            modelBlock.style.alignItems = 'center';
            modelBlock.style.background = '#f0f0f0';
            document.querySelector('.scene-control').style.flex = '1 0 auto';
        }
        if (window.navigator.platform.toLowerCase() == 'ipad') {
            const modelBlock = document.querySelector('.model-block');
            modelBlock.style.display = 'flex';
            modelBlock.style.flexDirection = 'column';
            modelBlock.style.justifyItems = 'flex-start';
            modelBlock.style.alignItems = 'center';
            document.querySelector('.scene-control').style.flex = '1 0 auto';
            //background
            /*document.querySelectorAll('.video-block__video').forEach(video => {
            	video.style.display = 'none';
            });
            document.querySelector('.iphone-background').style.display = 'block';*/
            //background
        }
        if (window.innerWidth < 992) {
            document.querySelector('.preloader__img').width = window.innerWidth;
            document.querySelector('.preloader__img').height = window.innerWidth * 2436 / 1125;
        } else {
            document.querySelector('.preloader__img').width = window.innerWidth;
            document.querySelector('.preloader__img').height = window.innerWidth;
        }
        const preloader = document.querySelector('.preloader');
        preloader.style.background = 'transparent';
        document.querySelector('.preloader__img').style.opacity = 0;
        document.querySelector('.main').style.display = 'flex';
        preloader.addEventListener('transitionend', function() {
            this.style.display = 'none';
        }, {
            once: true
        });
        initAnimation();
        document.querySelector('.solutions-block__head').style.blockSize = `${window.innerWidth / Number(document.querySelector('.solutions-block__head').dataset.ratio)}px`;
        document.querySelector('.about-head__img').style.blockSize = `${window.innerWidth / Number(document.querySelector('.about-head__img').dataset.ratio)}px`;
        if (window.innerWidth < 498) {
            document.querySelector('.characteristics-picture__img_schema').style.blockSize = `${document.querySelector('.characteristics-picture__img_schema').getBoundingClientRect().width / document.querySelector('.characteristics-picture__img_schema').dataset.ratio}px`;
        }
        if (window.innerWidth < 598) {
            document.querySelector('.characteristics-picture__img_description').style.blockSize = `${window.innerWidth - 28}px`;
        }
        if (window.innerWidth < 528) {
            document.querySelectorAll('.solution-text-block__img').forEach(img => {
                img.style.blockSize = `${(window.innerWidth - 28) / img.dataset.ratio}px`;
            });
        } else {
            document.querySelectorAll('.solution-text-block__img').forEach(img => {
                img.style.blockSize = '';
            });
        }
        let secondScreenVideosWidth = 320;
        let secondScreenVideosHeight = 240;
        if (window.innerWidth > 320) {
            secondScreenVideosWidth = 640;
            secondScreenVideosHeight = 480;
        }
        if (window.innerWidth > 640) {
            secondScreenVideosWidth = 720;
            secondScreenVideosHeight = 540;
        }
        if (window.innerWidth > 720) {
            secondScreenVideosWidth = 1920;
            secondScreenVideosHeight = 1080;
        }
        document.querySelector('.model-video_folding-arrow').width = secondScreenVideosWidth;
        document.querySelector('.model-video_folding-arrow').height = secondScreenVideosHeight;
        document.querySelector('.model-video_folding-arrow').innerHTML = `
			<source src="video/folding-arrow-${secondScreenVideosWidth}.webm" type="video/webm">
			<source src="video/folding-arrow-${secondScreenVideosWidth}.mp4" type="video/mp4">
			`;
        document.querySelector('.model-video_car-passage').width = secondScreenVideosWidth;
        document.querySelector('.model-video_car-passage').height = secondScreenVideosHeight;
        document.querySelector('.model-video_car-passage').innerHTML = `
			<source src="video/car-passage-${secondScreenVideosWidth}.webm" type="video/webm">
			<source src="video/car-passage-${secondScreenVideosWidth}.mp4" type="video/mp4">
			`;
        document.querySelector('.model-video_control-board').width = secondScreenVideosWidth;
        document.querySelector('.model-video_control-board').height = secondScreenVideosHeight;
        document.querySelector('.model-video_control-board').innerHTML = `
			<source src="video/control-board-${secondScreenVideosWidth}.webm" type="video/webm">
			<source src="video/control-board-${secondScreenVideosWidth}.mp4" type="video/mp4">
			`;
        document.querySelector('.model-video_unlocking').width = secondScreenVideosWidth;
        document.querySelector('.model-video_unlocking').height = secondScreenVideosHeight;
        document.querySelector('.model-video_unlocking').innerHTML = `
			<source src="video/unlocking-${secondScreenVideosWidth}.webm" type="video/webm">
			<source src="video/unlocking-${secondScreenVideosWidth}.mp4" type="video/mp4">
			`;
    };

    document.querySelectorAll('img').forEach(img => {
        img.addEventListener('load', () => {
            img.dataset.loaded = 'true';
            if (window.imgsToLoad) {
                window.imgsToLoad = window.imgsToLoad.filter(imgToLoad => {
                    if (imgToLoad.dataset.loaded == 'true') {
                        return false;
                    }
                    return true;
                });
                if (window.imgsToLoad.toString() == '' && window.imgsToLoad !== null) {
                    window.imgsToLoad = null;
                    document.querySelector('main').style.cursor = '';
                    scroll({
                        left: 0,
                        top: window.scrollY + window.elemToScroll.getBoundingClientRect().top + window.elemScrollOffset,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });

    document.querySelectorAll('.logo, .main-btn, .dop-btn_mail, .menu-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            let offset = 0;
            if (btn.dataset.offset) {
                offset = Number(btn.dataset.offset);
            }
            if (window.innerWidth > 340 && btn.dataset.offset340) {
                offset = Number(btn.dataset.offset340);
            }
            if (window.innerWidth > 576 && btn.dataset.offset576) {
                offset = Number(btn.dataset.offset576);
            }
            if (window.innerWidth > 768 && btn.dataset.offset768) {
                offset = Number(btn.dataset.offset768);
            }
            if (window.innerWidth > 992 && btn.dataset.offset992) {
                offset = Number(btn.dataset.offset992);
            }
            if (window.innerWidth > 1200 && btn.dataset.offset1200) {
                offset = Number(btn.dataset.offset1200);
            }
            if (window.innerWidth > 1460 && btn.dataset.offset1460) {
                offset = Number(btn.dataset.offset1460);
            }

            scroll({
                left: 0,
                top: window.scrollY + document.querySelector(btn.dataset.target).getBoundingClientRect().top + offset,
                behavior: 'smooth'
            });

            /*if ((window.navigator.platform.toLowerCase() == 'macintel' && window.navigator.userAgent.toLowerCase().indexOf('safari') > -1 && window.navigator.userAgent.toLowerCase().indexOf('chrome') == -1) || (window.navigator.platform.toLowerCase() == 'ipad')) {
            	scroll({
            		left: 0,
            		top: window.scrollY + document.querySelector(btn.dataset.target).getBoundingClientRect().top + offset,
            		behavior: 'smooth'
            	});
            	return;
            }
				
            let imgsOver = false;
            window.imgsToLoad = [];
            window.elemToScroll = document.querySelector(btn.dataset.target);
            window.elemScrollOffset = offset;
            document.querySelectorAll('section:not(.video-block) img, ' + btn.dataset.target).forEach(elem => {
            	if (imgsOver) return;
            	if (elem.classList.contains(btn.dataset.target.replace('.', ''))) {
            		imgsOver = true;
            		return;
            	}
            	if (elem.dataset.loaded != 'true') {
            		elem.loading = '';
            		window.imgsToLoad.push(elem);
            		document.querySelector('main').style.cursor = 'progress';
            	}
            });
				
            if (window.imgsToLoad.toString() == '') {
            	scroll({
            		left: 0,
            		top: window.scrollY + document.querySelector(btn.dataset.target).getBoundingClientRect().top + offset,
            		behavior: 'smooth'
            	});
            }*/
        });
    });

    document.querySelector('.dop-btn_video').addEventListener('click', function() {
        if (!document.querySelector('script[src="https://www.youtube.com/iframe_api"]')) {
            let script = document.createElement('script');
            script.src = 'https://www.youtube.com/iframe_api';
            document.getElementsByTagName('head')[0].appendChild(script);
            return;
        }
        if (document.querySelector('.popup').dataset.animation == 'animating') return;
        document.querySelector('.popup').dataset.animation = 'animating';
        document.querySelector('.popup').style.display = 'flex';
        document.querySelector('.popup__window_boom-barrier').style.display = 'flex';
        document.querySelector('.popup').offsetLeft;
        document.querySelector('.popup__window_boom-barrier').offsetLeft;
        document.querySelector('.popup').classList.add('popup_active');
        document.querySelector('.popup__window_boom-barrier').classList.add('popup__window_boom-barrier_active');
        window.videoPlayer.playVideo();
    });

    document.querySelectorAll('.model-video').forEach(video => {
        video.addEventListener('ended', e => {
            //console.log(`video ended ${e.srcElement.classList.contains('scene__animation_active')}`);
            if (!e.srcElement.classList.contains('scene__animation_active')) return;
            //const nextBtn = document.querySelector('.scene-slide-btn_active').closest('.scene-control__cell').nextElementSibling?.querySelector('.scene-slide-btn');
            let nextBtn = undefined;
            if (document.querySelector('.scene-slide-btn_active').closest('.scene-control__cell').nextElementSibling) {
                nextBtn = document.querySelector('.scene-slide-btn_active').closest('.scene-control__cell').nextElementSibling.querySelector('.scene-slide-btn');
            }
            document.querySelector('.scene-slide-btn_active').classList.remove('scene-slide-btn_active');
            if (nextBtn) {
                nextBtn.classList.add('scene-slide-btn_active');
            } else {
                document.querySelector('.scene-control__cell:first-child .scene-slide-btn').classList.add('scene-slide-btn_active');
            }
            document.querySelector('.scene__animation_active').style.opacity = 0;
            document.querySelector('.scene__animation_active').addEventListener('transitionend', () => {
                const nextVideo = document.querySelector('.scene__animation_active').nextElementSibling;
                document.querySelector('.scene__animation_active').pause();
                document.querySelector('.scene__animation_active').currentTime = 0;
                if (nextVideo) {
                    document.querySelector('.scene__animation_active').classList.remove('scene__animation_active');
                    nextVideo.pause();
                    nextVideo.currentTime = 0;
                    nextVideo.play();
                    nextVideo.classList.add('scene__animation_active');
                    nextVideo.offsetLeft;
                    nextVideo.style.opacity = 1;
                    return;
                }
                document.querySelector('.scene__videos').style.display = 'none';
                document.querySelector('.scene__animation_active').classList.remove('scene__animation_active');
                document.querySelector('.scene').style.paddingBlockEnd = '';
                document.querySelector('.arrows-animation').classList.add('scene__animation_active');
                document.querySelector('.arrows-animation').offsetLeft;
                document.querySelector('.arrows-animation').style.opacity = 1;
                startSceneAnimation();
            }, {
                once: true
            });
        });
    });

    document.querySelectorAll('.scene-slide-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            if (btn.classList.contains('scene-slide-btn_active')) return;
            scroll({
                left: 0,
                top: window.scrollY + document.querySelector('.model-block').getBoundingClientRect().top,
                behavior: 'smooth'
            });
            document.querySelector('.scene-slide-btn_active').classList.remove('scene-slide-btn_active');
            btn.classList.add('scene-slide-btn_active');
            document.querySelector('.scene__animation_active').style.opacity = 0;
            document.querySelector('.scene__animation_active').addEventListener('transitionend', () => {
                if (btn.classList.contains('scene-slide-btn_arrows')) {
                    document.querySelector('.scene__videos').style.display = 'none';
                    document.querySelector('.scene').style.paddingBlockEnd = '';
                    document.querySelector('.scene__animation_active').classList.remove('scene__animation_active');
                    document.querySelector('.arrows-animation').classList.add('scene__animation_active');
                    document.querySelector('.arrows-animation').offsetLeft;
                    document.querySelector('.arrows-animation').style.opacity = 1;
                    startSceneAnimation();
                    return;
                }
                window.cancelAnimationFrame(window.arrowAnimation);
                document.querySelector('.scene__videos').style.display = 'flex';
                document.querySelector('.scene__animation_active').classList.remove('scene__animation_active');
                document.querySelector('.scene').style.paddingBlockEnd = '0';
                document.querySelectorAll('.scene-slide-btn_video').forEach((btnVideo, i) => {
                    if (btnVideo != btn) return;
                    document.querySelector(`.model-video:nth-child(${i + 1})`).pause();
                    document.querySelector(`.model-video:nth-child(${i + 1})`).currentTime = 0;
                    document.querySelector(`.model-video:nth-child(${i + 1})`).play();
                    document.querySelector(`.model-video:nth-child(${i + 1})`).classList.add('scene__animation_active');
                    document.querySelector(`.model-video:nth-child(${i + 1})`).offsetLeft;
                    document.querySelector(`.model-video:nth-child(${i + 1})`).style.opacity = 1;
                });
            }, {
                once: true
            });
        });
    });

    document.querySelectorAll('.scene-big-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (btn.dataset.state == 'slides') {
                console.log('грузим 3д');
                scroll({
                    left: 0,
                    top: window.scrollY + document.querySelector('.model-block').getBoundingClientRect().top,
                    behavior: 'smooth'
                });
                if (document.querySelector('.model-block').getBoundingClientRect().top != 0) {
                    window.addEventListener('scroll', scrollToModel);
                } else {
                    document.querySelector('.model-block').style.position = 'fixed';
                    document.querySelectorAll('.main>section:not(.model-block), .main>div').forEach(elem => {
                        elem.style.display = 'none';
                    });
                }
                document.querySelector('.scene__animation_active').style.opacity = 0;
                document.querySelector('.scene__animation_active').addEventListener('transitionend', () => {
                    if (window.arrowAnimation) {
                        window.cancelAnimationFrame(window.arrowAnimation);
                    }
                    document.querySelector('.scene__animation_active').classList.remove('scene__animation_active');
                    document.querySelector('.scene').style.paddingBlockEnd = '0';
                    document.querySelector('.scene__videos').style.display = 'none';
                    document.querySelector('.scene__model').classList.add('scene__animation_active');
                    document.querySelector('.scene__model').offsetLeft;
                    document.querySelector('.scene__model').style.opacity = '1';
                    document.querySelector('.model-block').style.padding = '0'; //new 3d
                    document.querySelector('.model-block').style.minBlockSize = 'unset'; //new 3d
                    document.querySelector('.model-block').style.maxBlockSize = 'unset'; //new 3d
                    document.querySelector('.scene-control').classList.add('scene-control_3d'); // new 3d
                    document.querySelector('.scene-big-btn__img_3d').style.display = 'none'; //new 3d
                    document.querySelector('.scene-big-btn__img_close').style.display = 'inline'; //new 3d
                    if (document.querySelector('.scene__model').dataset.loaded == 'false') {
                        loadModel();
                    };
                    if (window.scene) {
                        window.scene.activeCamera.alpha = -.5 * Math.PI;
                        window.scene.activeCamera.beta = .5 * Math.PI;
                        if (window.innerWidth < 320) {
                            window.scene.activeCamera.radius = 9;
                        } else if (window.innerWidth < 370) {
                            window.scene.activeCamera.radius = 8;
                        } else if (window.innerWidth < 390) {
                            window.scene.activeCamera.radius = 9;
                        } else if (window.innerWidth < 460) {
                            window.scene.activeCamera.radius = 8;
                        } else if (window.innerWidth < 560) {
                            window.scene.activeCamera.radius = 7;
                        } else if (window.innerWidth < 1200) {
                            window.scene.activeCamera.radius = 6;
                        } else if (window.innerWidth < 1460) {
                            window.scene.activeCamera.radius = 5;
                        } else {
                            window.scene.activeCamera.radius = 4;
                        }
                    }
                }, {
                    once: true
                });
                document.querySelector('.scene-control__left').style.transform = 'translate(0, 64px)'; //new 3d
                document.querySelector('.scene-control__left').style.opacity = 0; //new 3d
                /*document.querySelector('.scene-big-btn__img_3d').style.display = 'none'; old
                document.querySelector('.scene-big-btn__img_close').style.display = 'inline';*/
                document.querySelector('.scene-slide-btn_active').classList.remove('scene-slide-btn_active');
                document.querySelectorAll('.scene-slide-btn').forEach(btn => {
                    btn.classList.add('scene-slide-btn_disabled');
                });
                document.querySelectorAll('.scene-slide-btn-text').forEach(text => {
                    text.classList.add('scene-slide-btn-text_disabled');
                });
                btn.dataset.state = '3d';
                return;
            }
            document.querySelector('.model-block').style.position = '';
            document.querySelectorAll('.main>section:not(.model-block), .main>div').forEach(elem => {
                elem.style.display = '';
            });
            scroll({
                left: 0,
                top: window.scrollY + document.querySelector('.model-block').getBoundingClientRect().top,
                behavior: 'instant'
            });
            document.querySelector('.scene__model').style.opacity = 0;
            document.querySelector('.scene__model').addEventListener('transitionend', () => {
                document.querySelector('.scene__model').classList.remove('scene__animation_active');
                document.querySelector('.arrows-animation').classList.add('scene__animation_active');
                document.querySelector('.arrows-animation').offsetLeft;
                document.querySelector('.arrows-animation').style.opacity = 1;
                document.querySelector('.scene').style.paddingBlockEnd = '';
                document.querySelector('.model-block').style.padding = ''; //new 3d
                document.querySelector('.model-block').style.minBlockSize = ''; //new 3d
                document.querySelector('.model-block').style.maxBlockSize = ''; //new 3d
                document.querySelector('.scene-control').classList.remove('scene-control_3d'); // new 3d
                document.querySelector('.scene-control__left').style.transform = 'translate(0, 0)'; //new 3d
                document.querySelector('.scene-control__left').style.opacity = ''; //new 3d
                startSceneAnimation();
            }, {
                once: true
            });
            document.querySelector('.scene-big-btn__img_close').style.display = 'none';
            document.querySelector('.scene-big-btn__img_3d').style.display = 'inline';
            document.querySelector('.scene-control__cell:first-child .scene-slide-btn').classList.add('scene-slide-btn_active');
            document.querySelectorAll('.scene-slide-btn').forEach(btn => {
                btn.classList.remove('scene-slide-btn_disabled');
            });
            document.querySelectorAll('.scene-slide-btn-text').forEach(text => {
                text.classList.remove('scene-slide-btn-text_disabled');
            });
            if (document.querySelector('.scene__model').dataset.loaded == 'false') {
                document.querySelector('.scene__model-preloader').style.display = 'none';
                document.querySelector('.scene-big-btn').classList.add('scene-big-btn_disabled');
                document.querySelector('.scene-big-btn__img_3d').style.display = 'none';
                document.querySelector('.scene-big-btn__img_close').style.display = '';
                document.querySelector('.scene-big-btn__preloader').style.display = 'flex';
            }
            btn.dataset.state = 'slides';
        });
    });

    document.querySelectorAll('.optional-block-photo__img, .optional-block-photo__text').forEach(elem => {
        elem.addEventListener('click', () => {
            if (document.querySelector('.optional-block-photo__description[data-state="opened"]')) return;
            const desc = elem.closest('.optional-block-photo').querySelector('.optional-block-photo__description');
            if (window.innerWidth < 576) {
                desc.style.display = 'block';
                desc.style.transitionDuration = '0s';
                desc.style.transform = `translate(${-Number(elem.closest('.optional-block-photo').getBoundingClientRect().left) + 14}px, 32px)`;
                desc.offsetLeft;
                desc.style.transitionDuration = '';
                desc.style.opacity = 1;
                desc.style.transform = `translate(${-Number(elem.closest('.optional-block-photo').getBoundingClientRect().left) + 14}px, 0)`;
                desc.addEventListener('transitionend', () => {
                    desc.dataset.state = 'opened';
                }, {
                    once: true
                });
                return;
            }
            if (window.innerWidth < 992) {
                desc.style.display = 'block';
                let i = 1;
                let index = 0;
                document.querySelectorAll('.optional-block-photo').forEach(photo => {
                    if (photo == elem.closest('.optional-block-photo')) {
                        index = i;
                    }
                    i++;
                });
                if (index % 2 == 0) {
                    desc.style.transitionDuration = '0s';
                    desc.style.transform = `translate(-258px, 32px)`;
                    desc.offsetLeft;
                    desc.style.transitionDuration = '';
                    desc.style.opacity = 1;
                    desc.style.transform = `translate(-258px, 0)`;
                } else {
                    desc.style.transitionDuration = '0s';
                    desc.style.transform = `translate(0, 32px)`;
                    desc.offsetLeft;
                    desc.style.transitionDuration = '';
                    desc.style.opacity = 1;
                    desc.style.transform = `translate(0, 0)`;
                }
            } else if (window.innerWidth < 1200) {
                desc.style.display = 'block';
                let i = 1;
                let index = 0;
                console.log(document.querySelectorAll('.optional-block-photo'));
                document.querySelectorAll('.optional-block-photo').forEach(photo => {
                    if (photo == elem.closest('.optional-block-photo')) {
                        index = i;
                    }
                    i++;
                });
                if ((index + 2) % 3 == 0) {
                    desc.style.transitionDuration = '0s';
                    desc.style.transform = `translate(0, 32px)`;
                    desc.offsetLeft;
                    desc.style.transitionDuration = '';
                    desc.style.opacity = 1;
                    desc.style.transform = `translate(0, 0)`;
                } else if ((index + 1) % 3 == 0) {
                    desc.style.transitionDuration = '0s';
                    desc.style.transform = `translate(-129px, 32px)`;
                    desc.offsetLeft;
                    desc.style.transitionDuration = '';
                    desc.style.opacity = 1;
                    desc.style.transform = `translate(-129px, 0)`;
                } else if (index % 3 == 0) {
                    desc.style.transitionDuration = '0s';
                    desc.style.transform = `translate(-258px, 32px)`;
                    desc.offsetLeft;
                    desc.style.transitionDuration = '';
                    desc.style.opacity = 1;
                    desc.style.transform = `translate(-258px, 0)`;
                }
            } else {
                desc.style.display = 'block';
                let i = 1;
                let index = 0;
                console.log(document.querySelectorAll('.optional-block-photo'));
                document.querySelectorAll('.optional-block-photo').forEach(photo => {
                    if (photo == elem.closest('.optional-block-photo')) {
                        index = i;
                    }
                    i++;
                });
                if ((index + 3) % 4 == 0) {
                    desc.style.transitionDuration = '0s';
                    desc.style.transform = `translate(0, 32px)`;
                    desc.offsetLeft;
                    desc.style.transitionDuration = '';
                    desc.style.opacity = 1;
                    desc.style.transform = `translate(0, 0)`;
                } else if ((index + 1) % 4 == 0 || (index + 2) % 4 == 0) {
                    desc.style.transitionDuration = '0s';
                    desc.style.transform = `translate(-129px, 32px)`;
                    desc.offsetLeft;
                    desc.style.transitionDuration = '';
                    desc.style.opacity = 1;
                    desc.style.transform = `translate(-129px, 0)`;
                } else if (index % 4 == 0) {
                    desc.style.transitionDuration = '0s';
                    desc.style.transform = `translate(-258px, 32px)`;
                    desc.offsetLeft;
                    desc.style.transitionDuration = '';
                    desc.style.opacity = 1;
                    desc.style.transform = `translate(-258px, 0)`;
                }
            }
            desc.style.opacity = 1;
            desc.addEventListener('transitionend', () => {
                desc.dataset.state = 'opened';
            }, {
                once: true
            });
            document.querySelectorAll('.optional-block-photo__img, .optional-block-photo__text').forEach(elem => {
                elem.style.cursor = 'default';
            });
        });
    });

    document.querySelectorAll('.optional-block-photo__description-close').forEach(close => {
        close.addEventListener('click', () => {
            if (!document.querySelector('.optional-block-photo__description[data-state="opened"]')) return;
            document.querySelectorAll('.optional-block-photo__description[data-state="opened"]').forEach(desc => {
                if (window.innerWidth < 576) {
                    desc.style.transform = `translate(${-Number(desc.closest('.optional-block-photo').getBoundingClientRect().left) + 14}px, 32px)`;
                } else if (window.innerWidth < 992) {
                    let i = 1;
                    let index = 0;
                    document.querySelectorAll('.optional-block-photo').forEach(photo => {
                        if (photo == desc.closest('.optional-block-photo')) {
                            index = i;
                        }
                        i++;
                    });
                    if (index % 2 == 0) {
                        desc.style.transform = `translate(-258px, 32px)`;
                    } else {
                        desc.style.transform = `translate(0, 32px)`;
                    }
                } else if (window.innerWidth < 1200) {
                    let i = 1;
                    let index = 0;
                    document.querySelectorAll('.optional-block-photo').forEach(photo => {
                        if (photo == desc.closest('.optional-block-photo')) {
                            index = i;
                        }
                        i++;
                    });
                    if ((index + 2) % 3 == 0) {
                        desc.style.transform = `translate(0, 32px)`;
                    } else if ((index + 1) % 3 == 0) {
                        desc.style.transform = `translate(-129px, 32px)`;
                    } else if (index % 3 == 0) {
                        desc.style.transform = `translate(-258px, 32px)`;
                    }
                } else {
                    let i = 1;
                    let index = 0;
                    document.querySelectorAll('.optional-block-photo').forEach(photo => {
                        if (photo == desc.closest('.optional-block-photo')) {
                            index = i;
                        }
                        i++;
                    });
                    if ((index + 3) % 4 == 0) {
                        desc.style.transform = `translate(0, 32px)`;
                    } else if ((index + 1) % 4 == 0 || (index + 2) % 4 == 0) {
                        desc.style.transform = `translate(-129px, 32px)`;
                    } else if (index % 4 == 0) {
                        desc.style.transform = `translate(-258px, 32px)`;
                    }
                }

                desc.style.opacity = 0;
                desc.addEventListener('transitionend', () => {
                    desc.style.display = '';
                    desc.dataset.state = 'closed';
                }, {
                    once: true
                });
                document.querySelectorAll('.optional-block-photo__img, .optional-block-photo__text').forEach(elem => {
                    elem.style.cursor = '';
                });
            });
        });
    });

    document.querySelector('.feedback-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        const response = await fetch('/', {
            method: 'POST',
            body: new FormData(this)
        });
        console.log(response);
        console.log("-----");
        if (!response.ok) {
            console.error(`Ошибка отправки формы, статус ответа: ${response.status}`);
            return;
        }
        if (await response.text() != '0') {
            console.log("формы");
            return;
        }
        gtag('event', 'feedback_form_filled');
        yaCounter68864038.reachGoal('feedback_form_filled');
        console.log(yaCounter68864038);
        if (document.querySelector('.popup').dataset.animation == 'animating') return;
        document.querySelector('.popup').dataset.animation = 'animating';
        document.querySelector('.popup').style.display = 'flex';
        document.querySelector('.popup__window_feedback').style.display = 'flex';
        document.querySelector('.popup').offsetLeft;
        document.querySelector('.popup__window_feedback').offsetLeft;
        document.querySelector('.popup').classList.add('popup_active');
        document.querySelector('.popup__window_feedback').classList.add('popup__window_feedback_active');
        setTimeout(() => {
            if (document.querySelector('.popup').dataset.animation == 'animating') return;
            document.querySelector('.popup').dataset.animation = 'animating';
            if (document.querySelector('.popup').dataset.state != 'opened') return;
            document.querySelector('.popup').classList.remove('popup_active');
            document.querySelector('.popup__window_feedback').classList.remove('popup__window_feedback_active');
            document.querySelector('.popup__window_feedback').style.transform = 'translate(0, 64px)';

            console.log(response);
        }, 3000);
    });

    document.querySelectorAll('.feedback-form-label__input').forEach(input => {
        input.addEventListener('focus', function() {
            const label = this.closest('.feedback-form-label');
            if (input.classList.contains('feedback-form-label__input_number')) {
                if (input.value == '') {
                    input.value = '+7 (';
                }
            }
            label.classList.add('feedback-form-label_active');
            label.querySelector('.feedback-form-label__placeholder').classList.add('feedback-form-label__placeholder_active');
        });
        input.addEventListener('blur', function() {
            const label = this.closest('.feedback-form-label');
            if (input.classList.contains('feedback-form-label__input_number')) {
                if (input.value == '+' || input.value == '+7' || input.value == '+7 (') {
                    input.value = '';
                }
            }
            label.classList.remove('feedback-form-label_active');
            if (label.querySelector('.feedback-form-label__input').value != '') return;
            label.querySelector('.feedback-form-label__placeholder').classList.remove('feedback-form-label__placeholder_active');
        });
        input.addEventListener('input', function(e) {
            const label = this.closest('.feedback-form-label');
            if (input.classList.contains('feedback-form-label__input_number')) {
                if (input.value == '') {
                    input.value = '+';
                }
                if (input.value.search(/^\+7/) != -1) {
                    const number = input.value.replace(/[^0-9]/g, '');
                    console.log('num ' + number);
                    if (number.length == 1) {
                        input.value = '+7 (';
                        console.log(1);
                    }
                    if (number.length > 1 && number.length <= 3) {
                        input.value = '+7 (' + number.substring(1);
                        console.log('13');
                    }
                    if (number.length > 3 && number.length <= 6) {
                        input.value = '+7 (' + number.substring(1, 4) + ') ' + number.substring(4, 7);
                        console.log('36');
                    }
                    if (number.length > 6 && number.length <= 8) {
                        input.value = '+7 (' + number.substring(1, 4) + ') ' + number.substring(4, 7) + ' ' + number.substring(7, 9);
                        console.log('68');
                    }
                    if (number.length > 8) {
                        input.value = '+7 (' + number.substring(1, 4) + ') ' + number.substring(4, 7) + ' ' + number.substring(7, 9) + '-' + number.substring(9, 11);
                        console.log('8');
                    }
                    if (e.inputType == 'deleteContentBackward') {
                        input.value = input.value.replace(/ $/g, '').replace(/\($/g, '').replace(/\)$/g, '').replace(/ $/g, '').replace(/-$/g, '');
                    }
                } else {
                    input.value = input.value.replace(/[^+0-9]/, '');
                }
                if (label.querySelector('.feedback-form-label__input').value != '+' && label.querySelector('.feedback-form-label__input').value != '+7' && label.querySelector('.feedback-form-label__input').value != '+7 (') {
                    label.querySelector('.feedback-form-label__placeholder').classList.add('feedback-form-label__placeholder_filled');
                    /*label.querySelector('.feedback-form-label__img')?.contentDocument.querySelectorAll('.st0').forEach(line => {
                    	line.style.fill = '#4785f9';
                    });*/
                    if (label.querySelector('.feedback-form-label__img')) {
                        label.querySelector('.feedback-form-label__img').contentDocument.querySelectorAll('.st0').forEach(line => {
                            line.style.fill = '#4785f9';
                        });
                    }
                    return;
                }
                label.querySelector('.feedback-form-label__placeholder').classList.remove('feedback-form-label__placeholder_filled');
                /*label.querySelector('.feedback-form-label__img')?.contentDocument.querySelectorAll('.st0').forEach(line => {
                	line.style.fill = '';
                });*/
                if (label.querySelector('.feedback-form-label__img')) {
                    label.querySelector('.feedback-form-label__img').contentDocument.querySelectorAll('.st0').forEach(line => {
                        line.style.fill = '';
                    });
                }
                return;
            }
            if (label.querySelector('.feedback-form-label__input').value != '') {
                label.querySelector('.feedback-form-label__placeholder').classList.add('feedback-form-label__placeholder_filled');
                /*label.querySelector('.feedback-form-label__img')?.contentDocument.querySelectorAll('.st0').forEach(line => {
                	line.style.fill = '#4785f9';
                });*/
                if (label.querySelector('.feedback-form-label__img')) {
                    label.querySelector('.feedback-form-label__img').contentDocument.querySelectorAll('.st0').forEach(line => {
                        line.style.fill = '#4785f9';
                    });
                }
                return;
            }
            label.querySelector('.feedback-form-label__placeholder').classList.remove('feedback-form-label__placeholder_filled');
            /*label.querySelector('.feedback-form-label__img')?.contentDocument.querySelectorAll('.st0').forEach(line => {
            	line.style.fill = '';
            });*/
            if (label.querySelector('.feedback-form-label__img')) {
                label.querySelector('.feedback-form-label__img').contentDocument.querySelectorAll('.st0').forEach(line => {
                    line.style.fill = '';
                });
            }
        });
    });

    document.querySelector('.feedback-contact__link_first-numer').addEventListener('click', () => {
        gtag('event', 'free_number_clicked');
        yaCounter68864038.reachGoal('free_number_clicked');
    });

    document.querySelector('.feedback-contact__link_second-numer').addEventListener('click', () => {
        gtag('event', 'spb_number_clicked');
        yaCounter68864038.reachGoal('spb_number_clicked');
    });

    document.querySelector('.feedback-contact__link_mail').addEventListener('click', () => {
        gtag('event', 'mailpercoru_number_clicked');
        yaCounter68864038.reachGoal('mailpercoru_mail_clicked');
    });

    document.querySelector('.feedback-form-policy-link').addEventListener('click', e => {
        e.preventDefault();
        if (document.querySelector('.popup').dataset.animation == 'animating') return;
        document.querySelector('.popup').dataset.animation = 'animating';
        document.querySelector('.popup').style.display = 'flex';
        document.querySelector('.popup__window_policy').style.display = 'flex';
        document.querySelector('.popup').offsetLeft;
        document.querySelector('.popup__window_policy').offsetLeft;
        document.querySelector('.popup').classList.add('popup_active');
        document.querySelector('.popup__window_policy').classList.add('popup__window_policy_active');
    });

    document.querySelector('.popup').addEventListener('click', function() {
        if (this.dataset.animation == 'animating') return;
        this.dataset.animation = 'animating';
        if (this.dataset.state != 'opened') return;
        document.querySelector('.popup').classList.remove('popup_active');
        if (document.querySelector('.popup__window_boom-barrier')) {
            document.querySelector('.popup__window_boom-barrier').classList.remove('popup__window_boom-barrier_active');
        }
        if (document.querySelector('.popup__window_policy')) {
            document.querySelector('.popup__window_policy').classList.remove('popup__window_policy_active');
        }
        if (document.querySelector('.popup__window_feedback')) {
            document.querySelector('.popup__window_feedback').classList.remove('popup__window_feedback_active');
            document.querySelector('.popup__window_feedback').style.transform = 'translate(0, 64px)';
        }
    });

    document.querySelector('.popup').addEventListener('transitionend', function() {
        console.log(document.querySelector('.popup').dataset.animation);
        document.querySelector('.popup').dataset.animation = 'static';
        if (this.dataset.state == 'closed') {
            this.dataset.state = 'opened';
            return;
        }
        if (this.dataset.state == 'opened') {
            this.dataset.state = 'closed';
            document.querySelector('.popup').style.display = 'none';
            document.querySelector('.popup__window_boom-barrier').style.display = 'none';
            document.querySelector('.popup__window_policy').style.display = 'none';
            document.querySelector('.popup__window_feedback').style.display = 'none';
            videoPlayer.stopVideo();
            videoPlayer.playVideo();
            videoPlayer.pauseVideo();
        }
    });

    document.querySelectorAll('.popup__window').forEach(popupWindow => {
        popupWindow.addEventListener('click', e => {
            e.stopPropagation();
        });

        popupWindow.addEventListener('transitionend', e => {
            e.stopPropagation();
        });
    });

    init();
    //});

    window.onYouTubeIframeAPIReady = () => {
        window.videoPlayer = new YT.Player('video', {
            width: '1024',
            height: '576',
            videoId: 'xKFm7QNyf2o',
            events: {
                'onReady': () => {
                    const popupWindow = document.querySelector('.popup__window_boom-barrier');
                    popupWindow.addEventListener('click', e => {
                        e.stopPropagation();
                    });
                    popupWindow.addEventListener('transitionend', e => {
                        e.stopPropagation();
                    });
                    if (window.ResizeObserver) {
                        (new ResizeObserver(e => {
                            let width, height;
                            if (window.innerWidth / window.innerHeight < 16 / 9) {
                                width = window.innerWidth * .9;
                                height = window.innerWidth * .9 * 9 / 16;
                                if (width > 1024) {
                                    width = 1024;
                                }
                                if (height > 576) {
                                    height = 576;
                                }
                                window.videoPlayer.setSize(width, height);
                            } else {
                                width = window.innerHeight * .9 * 16 / 9;
                                height = window.innerHeight * .9;
                                if (width > 1024) {
                                    width = 1024;
                                }
                                if (height > 576) {
                                    height = 576;
                                }
                                window.videoPlayer.setSize(width, height);
                            }
                        })).observe(document.querySelector('.popup'));
                    } else {
                        document.querySelector('.popup').addEventListener('resize', () => {
                            let width, height;
                            if (window.innerWidth / window.innerHeight < 16 / 9) {
                                width = window.innerWidth * .9;
                                height = window.innerWidth * .9 * 9 / 16;
                                if (width > 1024) {
                                    width = 1024;
                                }
                                if (height > 576) {
                                    height = 576;
                                }
                                window.videoPlayer.setSize(width, height);
                            } else {
                                width = window.innerHeight * .9 * 16 / 9;
                                height = window.innerHeight * .9;
                                if (width > 1024) {
                                    width = 1024;
                                }
                                if (height > 576) {
                                    height = 576;
                                }
                                window.videoPlayer.setSize(width, height);
                            }
                        });
                    }
                    let width, height;
                    if (window.innerWidth / window.innerHeight < 16 / 9) {
                        width = window.innerWidth * .9;
                        height = window.innerWidth * .9 * 9 / 16;
                        if (width > 1024) {
                            width = 1024;
                        }
                        if (height > 576) {
                            height = 576;
                        }
                        window.videoPlayer.setSize(width, height);
                    } else {
                        width = window.innerHeight * .9 * 16 / 9;
                        height = window.innerHeight * .9;
                        if (width > 1024) {
                            width = 1024;
                        }
                        if (height > 576) {
                            height = 576;
                        }
                        window.videoPlayer.setSize(width, height);
                    }
                    if (document.querySelector('.popup').dataset.animation == 'animating') return;
                    document.querySelector('.popup').dataset.animation = 'animating';
                    document.querySelector('.popup').style.display = 'flex';
                    document.querySelector('.popup__window_boom-barrier').style.display = 'flex';
                    document.querySelector('.popup').offsetLeft;
                    document.querySelector('.popup__window_boom-barrier').offsetLeft;
                    document.querySelector('.popup').classList.add('popup_active');
                    document.querySelector('.popup__window_boom-barrier').classList.add('popup__window_boom-barrier_active');
                    window.videoPlayer.playVideo();
                }
            }
        });
    };
})();