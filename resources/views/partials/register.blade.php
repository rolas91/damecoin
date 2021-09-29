<!--beging datos-->
<md-content layout-padding="layout-padding">
    <!--form-->
    <form name="projectForm" ng-submit="submitForm(projectForm.$valid)" novalidate>
        <div class='row'>
            <div class='col-sm-6'>
                <md-input-container class="md-block">
                    <label>Nombre</label>
                    <input
                        minlength="3"
                        required="required"
                        md-no-asterisk="md-no-asterisk"
                        name="name"
                        ng-model="name"
                        autocomplete='off'>
                        <div ng-messages="projectForm.name.$error">
                            <div ng-message="required">el nombre es requerido</div>
                            <div ng-message-exp="['minlength']">
                                el nombre minimo 3 caracteres
                            </div>
                        </div>
                        <md-input-container></div>
                        <div class='col-sm-6'>
                            <md-input-container class="md-block">
                                <label>Apellido</label>
                                <input
                                    minlength="3"
                                    required="required"
                                    md-no-asterisk="md-no-asterisk"
                                    name="lastname"
                                    ng-model="lastname"
                                    autocomplete='off'>
                                    <div ng-messages="projectForm.lastname.$error">
                                        <div ng-message="required">el apellido es requerido</div>
                                        <div ng-message-exp="['minlength']">
                                            el apellido minimo 3 caracteres
                                        </div>
                                    </div>
                                    <md-input-container></div>
                                    <div class='col-sm-6'>
                                        <md-input-container class="md-block">
                                            <label>Email</label>
                                            <input
                                                required="required"
                                                autocomplete='off'
                                                type="email"
                                                name="email"
                                                ng-model="email"
                                                minlength="10"
                                                maxlength="100"
                                                ng-pattern="/^.+@.+\..+$/"/>
                                            <div ng-messages="projectForm.email.$error" role="alert">
                                                <div ng-message="required">el email es requerido</div>
                                                <div ng-message-exp="['pattern']">
                                                    ingrese un email valido
                                                </div>
                                            </div>
                                        </md-input-container>
                                    </div>
                                    <div class='col-sm-6'>
                                        <md-input-container style="display:block">
                                            <label>Pais</label>
                                            <md-select name="country" ng-model="projectForm.country" required style="width:100%!important">
                                                <md-option value="es">España</md-option>
                                                <md-option value="co">Colombia</md-option>
                                            </md-select>
                                            <div ng-messages="projectForm.country.$error">
                                                <div ng-message="required">el pais es requerido.</div>
                                            </div>
                                        </md-input-container>
                                    </div>

                                </div>
                                <!--form-->
                            </form>
                            <!--
                            <md-button class="md-raised md-primary" ng-click='pay()'>Comprar @{{crypto}} </md-button>
                            -->
                        </md-content>
                        <!--end datos-->