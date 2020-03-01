import React from "react";
import Category from "../models/Category";
import 'bootstrap';
import { Week } from "../models/Week";
import DishComponent from "./DishComponent";
import { Modal, Button } from 'react-bootstrap';
import Select from 'react-select';
import axios from 'axios';
import settings from '../settings';
import _ from 'lodash';

export default class CategoryComponent extends React.Component<{data: Category, week: Week, deleteCategory: Function}, {dishes: Array<any>, modalShow: boolean,selectedOption: any, dishes_list: Array<Category>}> {

    constructor(props:any) {
        super(props);

        this.state = {
            dishes: this.props.data.dishes ? this.props.data.dishes : [],
            modalShow: false,
            selectedOption: null,
            dishes_list: [],
        };

        this.showModal = this.showModal.bind(this);
        this.closeModal = this.closeModal.bind(this);
    }

    showModal(e:any) {
        this.setState({modalShow: true});

        e.preventDefault();
    }

    closeModal() {
        this.setState({modalShow: false, selectedOption: false});
    }

    addDish(week:Week, category:Category) {
        if(this.state.selectedOption) {
            if(this.state.dishes.find(
                (element:any) => element.id == this.state.selectedOption.value
            ) === undefined) {
                axios.request({
                    url: settings.APP_URL+'/dishes/sync/'+week.id+'/'+category.id+'/'+this.state.selectedOption.value
                }).then((response: {data: Category}) => {
                    let new_dishes = this.state.dishes;
    
                    new_dishes.push(response.data);
    
                    this.setState({dishes: new_dishes, selectedOption: false});
                    this.closeModal();
                });
            } else {
                alert('Выбранное блюдо уже есть!');
            }

        } else {
            alert('Выберите блюдо!');
        }
    }

    deleteDish = (week:Week, category:Category, dish:any) => {
        let delete_q = confirm("Вы уверены, что хотите удалить блюдо?");

        if(delete_q) {
            axios.delete(settings.APP_URL+'/dishes/sync/'+week.id+'/'+category.id+'/'+dish.id)
            .then((response: {data: Category}) => {

                let new_dishes = this.state.dishes;
                
                _.remove(new_dishes, (n) => {
                    return n.id == response.data.id;
                });

                this.setState({dishes: new_dishes, selectedOption: false});
            });
        }
    }

    componentDidMount() {
        this.loadDishes();
    }

    loadDishes() {
        axios.request({
            url: settings.APP_URL+'/dishes'
        }).then((response: {data: {data: Array<any>}}) => {
            this.setState({dishes_list: response.data.data});
        });
    }

    handleChange = (selectedOption:any) => {
      this.setState(
        { selectedOption: selectedOption }
      );
    };

    render() {
        let category = this.props.data;
        let week = this.props.week;
        let dishes = this.state.dishes.map((value:any) => <DishComponent key={value.id} data={value} week={week} category={category} deleteDish={this.deleteDish}/>);

        return <>
        <div className="accordion category" id={'c'+week.id+'_'+category.id}>
            <div className="card">
                <div className="card-header" id={'headingC'+week.id+'_'+category.id}>
                    <h2 className="mb-0">
                    <button className="btn btn-link" type="button" data-toggle="collapse" data-target={'#collapseOne'+week.id+'_'+category.id} aria-expanded="false" aria-controls={'collapseOne'+week.id+'_'+category.id}>
                        {category.name}
                    </button>
                    <span onClick={() => this.props.deleteCategory(week, category)} style={{float: 'right', fontSize: '1rem', cursor: 'pointer', margin: '10px', color: '#d46d6d'}}>Удалить</span>
                    </h2>
                </div>
            
                <div id={'collapseOne'+week.id+'_'+category.id} className="collapse" aria-labelledby={'headingC'+week.id+'_'+category.id} data-parent={"#"+'c'+week.id+'_'+category.id}>
                    <div className="card-body">
                        {dishes}
                        <hr/>
                        <a href="#" style={{fontSize: "1rem", marginTop: "10px", display: 'inline-block',cursor: 'pointer'}} onClick={this.showModal}>Добавить блюдо</a>
                    </div>
                </div>
            </div>
        </div>
        <Modal show={this.state.modalShow} onHide={this.closeModal}>
        <Modal.Header closeButton>
            <Modal.Title>Добавить блюдо</Modal.Title>
        </Modal.Header>
        <Modal.Body>
            <p>Выберите блюдо, чтобы связать ее с неделей и категорией</p>
            <a href={settings.APP_URL.replace('/api', '')+'/admin/dishes'} target="_blank">Или создайте новое блюдо</a>
            <Select
                placeholder={"Выберите блюдо"}
                value={this.state.selectedOption}
                onChange={this.handleChange}
                options={this.state.dishes_list.map((value:any, key:any) => ({value: value.id, label: value.name}))}
            />
        </Modal.Body>
        <Modal.Footer>
            <Button variant="secondary" onClick={this.closeModal}>
            Отмена
            </Button>
            <Button variant="primary" onClick={() => this.addDish(week, this.props.data)}>
            Сохранить
            </Button>
        </Modal.Footer>
        </Modal>
        </>;
    }
}