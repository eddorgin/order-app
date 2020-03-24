import React, { Component } from 'react';
import API from "./utils/api";
import {getDeliveryDays, mapDaysByTariffs} from "./utils/tariff";
import {getDay} from "./utils/tariff";
import {generateSelectOptionsByTariffs} from "./utils/tariff";
import {generateSelectOptionsByDeliveryDays} from "./utils/tariff";
import {getTariffs} from "./utils/tariff";

class Tariff extends Component
{
    constructor(props) {
        super(props);
        this.state = {
            isLoading: true,
            tariffSelectOptions: <option>Идет получение тарифов...</option>,
            deliveryDaysSelectOptions: <option>Нет информации</option>,
            selectedTariffId: 0,
            selectedDay: 0,
            days: []
        };

        this.handleChange = this.handleChange.bind(this);
        this.handleChangeDay = this.handleChangeDay.bind(this);
    }

    handleChange(event) {
        this.setState({selectedTariffId: event.target.value});
        let days = getDay(this.state.days, event.target.value);
        let dayOptions = generateSelectOptionsByDeliveryDays(
            days,
            (day) => { return <option value={day}>{day}</option>}
        );
        this.setState({deliveryDaysSelectOptions: dayOptions});
        const text = event.target.value;
        this.props.onChange('tariff_id', text);
        this.props.onChange('delivery_day', days[0][0]);
    }

    handleChangeDay(event) {
        this.setState({selectedDay: event.target.value});
        const text = event.target.value;
        this.props.onChange('delivery_day', text);
    }

    async componentDidMount() {
        try {
            let tariffs = await API.get('/tariffs');
            tariffs = getTariffs(tariffs);
            let options = generateSelectOptionsByTariffs(
                tariffs,
                (tariff) => {return <option value={tariff.id}>{tariff.name}</option>}
            );
            let days = mapDaysByTariffs(tariffs);
            let deliveryDays = getDeliveryDays(days);
            let dayOptions = generateSelectOptionsByDeliveryDays(
                deliveryDays,
                (day) => { return <option value={day}>{day}</option>}
            );
            let selectedTariffId = tariffs[0].id;
            let selectedDay = deliveryDays[0][0];

            this.setState({
                isLoading: false,
                tariffSelectOptions: options,
                deliveryDaysSelectOptions:dayOptions,
                selectedTariffId: selectedTariffId,
                selectedDay: selectedDay,
                days: days

            });

            this.props.onChange('tariff_id', selectedTariffId);
            this.props.onChange('delivery_day', selectedDay);
        } catch (e) {
            console.log(`Axios request failed: ${e}`);
        }
    }

    render() {
        const { tariffSelectOptions, deliveryDaysSelectOptions } = this.state;
        return (
            <div>
                <div className="form-group row">
                    <label htmlFor="tariffs" className="col-sm-2 col-form-label">Выберите тариф</label>
                    <select
                        name="tariff_id"
                        id="tariffs"
                        className="form-control col-sm-10"
                        value={this.state.selectedTariffId}
                        onChange={this.handleChange}
                    >
                        {tariffSelectOptions}
                    </select>
                </div>
                <div className="form-group row">
                    <label htmlFor="delivery_day" className="col-sm-2 col-form-label">Выберите день доставки</label>
                    <select
                        id="delivery_day"
                        className="form-control col-sm-10"
                        value={this.state.selectedDay}
                        onChange={this.handleChangeDay}
                    >
                        {deliveryDaysSelectOptions}
                    </select>
                </div>
            </div>
        );
    }
}

export default Tariff;