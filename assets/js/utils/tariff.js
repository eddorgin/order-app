export function mapDaysByTariffs(tariffs) {
    return tariffs.map((tariff) => { return {id: tariff.id, days: tariff.deliveryDays}});
}

export function generateSelectOptionsByTariffs(tariffs, call) {
    return tariffs.map(call)
}

export function generateSelectOptionsByDeliveryDays(deliveryDays, call) {
    return deliveryDays[0].map(call);
}

export function getDeliveryDays(days) {
    let deliveryDays = days.map((dayOptions) => {
        return dayOptions.days
    });
    return  deliveryDays.filter((elem) => elem != null);
}

export function getDay(days, value) {
    let deliveryDays = days.map((dayOptions) => {
        if (dayOptions.id == value) {
            return dayOptions.days
        }
    });
    return  deliveryDays.filter((elem) => elem != null);
}

export function getTariffs(response) {
    return response.data;
}