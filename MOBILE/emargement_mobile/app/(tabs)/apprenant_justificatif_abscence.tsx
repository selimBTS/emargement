import React, { useState } from 'react';
import { View, Text, TextInput, TouchableOpacity, StyleSheet, Image, CheckBox } from 'react-native';
import * as DocumentPicker from 'expo-document-picker';

export default function ApprenantJustificatifAbscence() {
  const [justification, setJustification] = useState('');
  const [startDate, setStartDate] = useState('');
  const [endDate, setEndDate] = useState('');
  const [document, setDocument] = useState(null);
  const [accepted, setAccepted] = useState(false);

  const handlePickDocument = async () => {
    const result = await DocumentPicker.getDocumentAsync({});
    if (result.type === 'success') {
      setDocument(result);
    }
  };

  const handleSubmit = () => {
    if (justification && startDate && endDate && document && accepted) {
      console.log('Formulaire envoyé avec :', { justification, startDate, endDate, document });
    } else {
      alert('Veuillez remplir tous les champs et accepter les conditions.');
    }
  };

  return (
    <View style={styles.container}>
      <View style={styles.header}>
        <View style={styles.avatar}><Text style={styles.avatarText}>AK</Text></View>
        <Image source={require('../assets/gefor-logo.png')} style={styles.logo} />
      </View>

      <Text style={styles.pageTitle}>Justifier une absence</Text>

      <View style={styles.card}>
        <Text style={styles.description}>La demande de justification sera envoyée à un administrateur pour validation.</Text>

        <TextInput
          placeholder="Justification"
          style={styles.input}
          value={justification}
          onChangeText={setJustification}
        />

        <TextInput
          placeholder="Date de début"
          style={styles.input}
          value={startDate}
          onChangeText={setStartDate}
        />

        <TextInput
          placeholder="Date de fin"
          style={styles.input}
          value={endDate}
          onChangeText={setEndDate}
        />

        <TouchableOpacity style={styles.uploadBtn} onPress={handlePickDocument}>
          <Text style={styles.uploadBtnText}>{document ? document.name : 'Document :'}</Text>
        </TouchableOpacity>

        <View style={styles.checkboxContainer}>
          <CheckBox
            value={accepted}
            onValueChange={setAccepted}
          />
          <Text style={styles.termsText}>
            En validant votre demande de justification d'absence, vous acceptez que vos données puissent être stockées pour la durée maximale légale de conservation. Vos données seront traitées dans le cadre du service proposé par GEFOR à l'organisation à laquelle vous appartenez, afin de justifier votre absence en formation.
          </Text>
        </View>

        <TouchableOpacity style={styles.submitBtn} onPress={handleSubmit}>
          <Text style={styles.submitText}>Envoyer un justificatif</Text>
        </TouchableOpacity>
      </View>

      <View style={styles.footer}>
        <TouchableOpacity><Text style={styles.footerItem}>🏠\nAccueil</Text></TouchableOpacity>
        <TouchableOpacity><Text style={styles.footerItem}>📅\nCalendrier</Text></TouchableOpacity>
        <TouchableOpacity><Text style={styles.footerItem}>👤\nProfil</Text></TouchableOpacity>
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#F1F3F5', paddingTop: 40, paddingHorizontal: 20 },
  header: { flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center', marginBottom: 10 },
  avatar: { backgroundColor: '#E85421', width: 40, height: 40, borderRadius: 20, justifyContent: 'center', alignItems: 'center' },
  avatarText: { color: 'white', fontWeight: 'bold' },
  logo: { width: 100, height: 30, resizeMode: 'contain' },
  pageTitle: { fontWeight: 'bold', fontSize: 18, marginBottom: 15, color: '#0E1E5B' },
  card: { backgroundColor: '#fff', borderRadius: 12, padding: 15, marginBottom: 20, elevation: 3 },
  description: { marginBottom: 10, color: '#212529' },
  input: { backgroundColor: '#fff', borderColor: '#ccc', borderWidth: 1, borderRadius: 8, padding: 10, marginBottom: 10 },
  uploadBtn: { backgroundColor: '#eee', padding: 10, borderRadius: 8, alignItems: 'center', marginBottom: 10 },
  uploadBtnText: { color: '#0E1E5B' },
  checkboxContainer: { flexDirection: 'row', alignItems: 'flex-start', marginVertical: 10 },
  termsText: { fontSize: 12, color: '#212529', marginLeft: 10, flex: 1 },
  submitBtn: { backgroundColor: '#0E1E5B', padding: 15, borderRadius: 8, alignItems: 'center' },
  submitText: { color: 'white', fontWeight: 'bold' },
  footer: { flexDirection: 'row', justifyContent: 'space-around', paddingVertical: 10, borderTopWidth: 1, borderColor: '#ccc', backgroundColor: '#fff' },
  footerItem: { textAlign: 'center', fontSize: 12, color: '#212529' }
});