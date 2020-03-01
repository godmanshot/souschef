import { WeekProperty, Week } from "../models/Week";
import React from "react";
import { FaRegCalendar } from 'react-icons/fa';
import Category, { CategoryProperty } from "../models/Category";
import CategoryComponent from "./CategoryComponent";
import { FaPlus } from 'react-icons/fa';
import { Modal, Button } from 'react-bootstrap';
import Select from 'react-select';
import axios from 'axios';
import settings from '../settings';
import _ from 'lodash';

export default class WeekComponent extends React.Component<{data: Week, deleteWeek: Function}, {modalShow: boolean, add_category_items: Array<Category>, add_selected_item: any, categories: Array<Category>}> {
    constructor(props: any) {
        super(props);

        this.state = {
            modalShow: false,
            add_category_items: [],
            add_selected_item: false,
            categories: this.props.data.categories ? this.props.data.categories : []
        };

        this.showModal = this.showModal.bind(this);
        this.closeModal = this.closeModal.bind(this);
        this.loadCategories = this.loadCategories.bind(this);
        this.addCategory = this.addCategory.bind(this);
    }

    componentDidMount() {
        this.loadCategories();
    }

    showModal() {
        this.setState({modalShow: true});
    }

    closeModal() {
        this.setState({modalShow: false, add_selected_item: false});
    }

    loadCategories() {
        axios.request({
            url: settings.APP_URL+'/categories'
        }).then((response: {data: {data: Array<CategoryProperty>}}) => {
            this.setState({add_category_items: response.data.data});
        });
    }

    handleChange = (selectedOption:any) => {
      this.setState(
        { add_selected_item: selectedOption }
      );
    };

    addCategory(week:Week) {
        if(this.state.add_selected_item) {
            if(this.state.categories.find(
                (element) => element.id == this.state.add_selected_item.value
            ) === undefined) {
                axios.request({
                    url: settings.APP_URL+'/weeks/'+week.id+'/sync/'+this.state.add_selected_item.value+''
                }).then((response: {data: Category}) => {
                    let new_categories = this.state.categories;
    
                    new_categories.push(response.data);
    
                    this.setState({categories: new_categories, add_selected_item: false});
                    this.closeModal();
                });
            } else {
                alert('Выбранная категория уже есть!');
            }

        } else {
            alert('Выберите категорию!');
        }
    }

    deleteCategory = (week:Week, category:Category) => {
        let delete_q = confirm("Вы уверены, что хотите удалить категорию?");

        if(delete_q) {
            axios.delete(settings.APP_URL+'/weeks/'+week.id+'/sync/'+category.id)
            .then((response: {data: Category}) => {

                let new_categories = this.state.categories;
                
                _.remove(new_categories, (n) => {
                    return n.id == response.data.id;
                });

                this.setState({categories: new_categories, add_selected_item: false});
            });
        }
    }

    render() {

        let categories:any = this.state.categories;
        if(categories) {
            categories = categories.sort((a:Category, b:Category) => (a.pivot.order - b.pivot.order))
            .map((value: Category) => <CategoryComponent key={value.id} data={new Category(value)} week={this.props.data} deleteCategory={this.deleteCategory}/>);
        }

        return <>
            <div className="week">
                <h3 className="title">
                    <FaRegCalendar/> {this.props.data.name}
                    <span onClick={() => this.props.deleteWeek(this.props.data)} style={{color: '#fff', float: 'right', fontSize: '1rem', cursor: 'pointer'}}>Удалить</span>
                </h3>
                <div className="categories">
                    {categories}
                </div>
                <h4 className="add_category" onClick={this.showModal}><FaPlus /> Добавить категорию</h4>
            </div>
            <Modal show={this.state.modalShow} onHide={this.closeModal}>
            <Modal.Header closeButton>
                <Modal.Title>Добавить категорию</Modal.Title>
            </Modal.Header>
            <Modal.Body>
                <p>Выберите категорию, чтобы связать ее с неделей</p>
                <a href={settings.APP_URL.replace('/api', '')+'/admin/categories'} target="_blank">Или создайте новую категорию</a>
                <Select
                    placeholder={"Выберите категорию"}
                    value={this.state.add_selected_item}
                    onChange={this.handleChange}
                    options={this.state.add_category_items.map((value, key) => ({value: value.id, label: value.name}))}
                />
            </Modal.Body>
            <Modal.Footer>
                <Button variant="secondary" onClick={this.closeModal}>
                Отмена
                </Button>
                <Button variant="primary" onClick={() => this.addCategory(this.props.data)}>
                Сохранить
                </Button>
            </Modal.Footer>
            </Modal>
        </>;
    }
}