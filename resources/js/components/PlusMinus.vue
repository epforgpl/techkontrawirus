<!-- Credit: based on https://github.com/Keiwen/vue-integer-plusminus -->

<template>
    <div>
        <button :class="getBtnClass(true)" @click="onPlusMinusClick(true)" :disabled="this.vote === -1" :key="'btn-up-' + this.key">
            <span class="icon icon-arrow-up"></span>
        </button>
        <div class="button-value" tabindex="0" :key="'value-' + this.key">{{ value }}</div>
        <button :class="getBtnClass(false)" @click="onPlusMinusClick(false)" :disabled="this.vote === 1" :key="'btn-down-' + this.key">
            <span class="icon icon-arrow-down"></span>
        </button>
    </div>
</template>

<script>
    export default {
        name: 'PlusMinus',
        props: {
            valueOnLoad: {
                default: 0,
                type: Number
            },
            ajaxUrl: {
                default: null,
                type: String
            },
            voteOnLoad: {
                default: 0,
                type: Number
            },
            // https://vuejs.org/v2/guide/conditional.html#Controlling-Reusable-Elements-with-key
            key: {
                default: 0,
                type: Number
            }
        },
        data () {
            return {
                value: 0,
                vote: 0
            }
        },
        created () {
            this.value = this.valueOnLoad;
            this.vote = this.voteOnLoad;
        },
        methods: {
            getBtnClass(isPlus) {
                let valueWhenOn = isPlus ? 1 : -1;
                let oppositeValue = -1 * valueWhenOn;
                return (isPlus ? 'up' : 'down')
                    + ' '
                    + ((valueWhenOn === this.vote) ? 'marked' : '')
                    + ' '
                    + ((oppositeValue === this.vote) ? 'disabled' : '');
            },
            onPlusMinusClick(isPlus) {
                switch (this.vote) {
                    case 1:
                        isPlus ? this.zeroOut() : this.noOp();
                        break;
                    case 0:
                        isPlus ? this.increment() : this.decrement();
                        break;
                    case -1:
                        isPlus ? this.noOp() : this.zeroOut();
                        break;
                    default:
                        break;
                }
            },
            increment () {
                this.vote = 1;
                this.value = this.value + 1;
                this.$http.post(this.ajaxUrl, {is_plus: 1, is_canceling: 0})
                    .then(response => {}, response => {});
            },
            decrement () {
                this.vote = -1;
                this.value = this.value - 1;
                this.$http.post(this.ajaxUrl, {is_plus: 0, is_canceling: 0})
                    .then(response => {}, response => {});
            },
            zeroOut () {
                let isPlus = (this.vote === 1);
                this.vote = 0;
                this.value = this.value - (isPlus ? 1 : -1);
                this.$http.post(this.ajaxUrl, {is_plus: (isPlus ? 1 : 0), is_canceling: 1})
                    .then(response => {}, response => {});
            },
            noOp() {}
        }
    }
</script>

<style lang="scss" scoped>
    @import '../../sass/_variables.scss';

    button {
        background-color: transparent;
        border: none;
        border-radius: 0.2rem;
        padding: 0.3rem 0.6rem;
        &:hover:not(.disabled), &.marked {
            background-color: rgba(0, 0, 0, 0.06);
            &.up {
                .icon {
                    color: $green;
                }
            }
            &.down {
                .icon {
                    color: $red;
                }
            }
        }
        &.disabled {
            cursor: not-allowed;
            .icon {
                color: #dddddd;
            }
        }
        .icon {
            color: #999;
        }
    }
    .button-value {
        font-weight: bold;
        outline: none;
    }
</style>
