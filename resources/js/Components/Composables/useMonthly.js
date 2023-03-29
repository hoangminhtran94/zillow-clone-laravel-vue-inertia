import { computed, isRef } from "vue";

export const useMonthlyPayment = (price, interest, duration) => {
    const monthlyPayment = computed(() => {
        const principle = isRef(price) ? price.value : price;
        const monthlyInterest =
            (isRef(interest) ? interest.value : interest) / 100 / 12;
        const numberOfPaymentMonths =
            (isRef(duration) ? duration.value : duration) * 12;
        return (
            (principle *
                monthlyInterest *
                Math.pow(1 + monthlyInterest, numberOfPaymentMonths)) /
            (Math.pow(1 + monthlyInterest, numberOfPaymentMonths) - 1)
        );
    });

    const totalPaid = computed(() => {
        return (
            (isRef(duration) ? duration.value : duration) *
            12 *
            monthlyPayment.value
        );
    });

    const totalInterest = computed(
        () => totalPaid.value - (isRef(price) ? price.value : price)
    );
    return { monthlyPayment, totalInterest, totalPaid };
};
