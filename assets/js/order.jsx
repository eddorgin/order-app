import React, { Component } from 'react';
import Tariff from "./tariff";
import API from "./utils/api";

class Order extends Component {
    constructor() {
        super();
        this.state = {
            name: '',
            phone: '',
            address: '',
            tariff_id: '',
            delivery_day: ''
        };

        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChangeName = this.handleChangeName.bind(this);
        this.handleChangePhone = this.handleChangePhone.bind(this);
        this.handleChangeTariff = this.handleChangeTariff.bind(this);
        this.handleChangeAddress = this.handleChangeAddress.bind(this);
    }

    handleSubmit(event) {
        event.preventDefault();

        let data = new FormData;
        data.set('name', this.state.name);
        data.set('phone', this.state.phone);
        data.set('address', this.state.address);
        data.set('tariff_id', this.state.tariff_id);
        data.set('delivery_day', this.state.delivery_day);

        API.post('/orders', data);
    }

    handleChangeName(event) {
        const name = event.target.value;
        this.setState({
            name: name
        });
    }

    handleChangePhone(event) {
        const phone = event.target.value;
        this.setState({
            phone: phone
        });
    }

    handleChangeAddress(event) {
        const adress = event.target.value;
        this.setState({
            address: adress
        });
    }

    handleChangeTariff(fieldId, value) {
        this.setState({ [fieldId]: value });
    }

    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-sm-12">
                        <h5 className="card-title text-center">Форма заказа</h5>
                        <form onSubmit={this.handleSubmit}>
                            <div className="form-group row">
                                <label htmlFor="name" className="col-sm-2 col-form-label">Введите имя</label>
                                <input
                                    onChange={this.handleChangeName}
                                    type="text"
                                    className="form-control col-sm-10"
                                    name="name"
                                    id="name"
                                    placeholder="Иван"
                                    required
                                />
                            </div>
                            <div className="form-group row">
                                <label htmlFor="phone" className="col-sm-2 col-form-label">Введите номер телефона</label>
                                <input
                                    onChange={this.handleChangePhone}
                                    type="text"
                                    className="form-control col-sm-10"
                                    name="phone"
                                    id="phone"
                                    placeholder="+79005003322"
                                    required
                                />
                            </div>
                            <Tariff onChange={this.handleChangeTariff} key="tariff"/>
                            <div className="form-group row">
                                <label htmlFor="deliveryAddress" className="col-sm-2 col-form-label">
                                    Введите адрес доставки
                                </label>
                                <input
                                    onChange={this.handleChangeAddress}
                                    type="text"
                                    className="form-control col-sm-10"
                                    name="address"
                                    id="deliveryAddress"
                                    placeholder="г.Моска, ул.Мира, д.12, кв.7"
                                    required
                                />
                            </div>
                            <button type="submit" className="btn btn-primary">Сделать заказ</button>
                        </form>
                    </div>
                </div>
            </div>
        );
    }
}

export default Order;