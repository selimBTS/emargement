import React from 'react';
import { View, Text, StyleSheet, TouchableOpacity, ScrollView, Image } from 'react-native';
import { Ionicons } from '@expo/vector-icons';

export default function AcceuilApprenantMobile() {
  return (
    <View style={styles.container}>
      <View style={styles.header}>
        <View style={styles.avatar}><Text style={styles.avatarText}>AK</Text></View>
        <Image source={require('../assets/gefor-logo.png')} style={styles.logo} />
      </View>

      <View style={styles.rowBetween}>
        <Text style={styles.welcome}>Bonjour Apprenant</Text>
        <TouchableOpacity style={styles.absenceBtn}>
          <Text style={styles.absenceBtnText}>Justifier une absence</Text>
        </TouchableOpacity>
      </View>

      <Text style={styles.sectionTitle}>Emargement</Text>

      <ScrollView style={styles.scrollContainer}>
        <Text style={styles.subTitle}>Aujourd'hui - Après-midi (2)</Text>

        <View style={styles.cardRed}>
          <Ionicons name="book" size={16} color="red" />
          <Text style={styles.cardText}>Anglais salle C</Text>
          <Text style={styles.cardTime}>17h15 - 18h00</Text>
        </View>

        <View style={styles.card}>
          <Ionicons name="book" size={16} color="#0E1E5B" />
          <Text style={styles.cardText}>Cejm salle B</Text>
          <Text style={styles.cardTime}>18h00 - 19h00</Text>
        </View>

        <Text style={styles.subTitle}>Passés - (2)</Text>

        <View style={[styles.card, styles.pastCard]}>
          <Text style={styles.cardText}>Anglais salle C</Text>
          <Text style={styles.cardTime}>17h15 - 18h00</Text>
        </View>

        <View style={[styles.card, styles.pastCard]}>
          <Text style={styles.cardText}>Cejm salle B</Text>
          <Text style={styles.cardTime}>18h00 - 19h00</Text>
        </View>
      </ScrollView>

      <View style={styles.footer}>
        <TouchableOpacity><Text style={styles.footerItem}>🏠\nAccueil</Text></TouchableOpacity>
        <TouchableOpacity><Text style={styles.footerItem}>📅\nCalendrier</Text></TouchableOpacity>
        <TouchableOpacity><Text style={styles.footerItem}>👤\nProfil</Text></TouchableOpacity>
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#F1F3F5',
    paddingTop: 40,
  },
  header: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    paddingHorizontal: 20,
    paddingBottom: 10,
  },
  avatar: {
    backgroundColor: '#E85421',
    width: 40,
    height: 40,
    borderRadius: 20,
    justifyContent: 'center',
    alignItems: 'center'
  },
  avatarText: {
    color: 'white',
    fontWeight: 'bold'
  },
  logo: {
    width: 100,
    height: 30,
    resizeMode: 'contain'
  },
  rowBetween: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    paddingHorizontal: 20,
    alignItems: 'center'
  },
  welcome: {
    fontWeight: 'bold',
    fontSize: 16,
    color: '#0E1E5B'
  },
  absenceBtn: {
    backgroundColor: '#0E1E5B',
    borderRadius: 8,
    paddingHorizontal: 12,
    paddingVertical: 6
  },
  absenceBtnText: {
    color: 'white',
    fontWeight: '600'
  },
  sectionTitle: {
    backgroundColor: '#dee2e6',
    padding: 10,
    fontWeight: 'bold',
    color: '#212529',
    fontSize: 16
  },
  scrollContainer: {
    paddingHorizontal: 20,
    marginTop: 10
  },
  subTitle: {
    fontWeight: 'bold',
    color: '#212529',
    marginVertical: 10
  },
  card: {
    backgroundColor: '#fff',
    borderRadius: 12,
    padding: 15,
    marginBottom: 10,
    shadowColor: '#000',
    shadowOpacity: 0.1,
    shadowOffset: { width: 0, height: 2 },
    shadowRadius: 4,
    elevation: 3,
  },
  cardRed: {
    backgroundColor: '#fff',
    borderLeftWidth: 4,
    borderLeftColor: 'red',
    padding: 15,
    borderRadius: 12,
    marginBottom: 10
  },
  cardText: {
    fontWeight: '600',
    fontSize: 14
  },
  cardTime: {
    color: '#6C757D',
    marginTop: 4
  },
  pastCard: {
    opacity: 0.5
  },
  footer: {
    flexDirection: 'row',
    justifyContent: 'space-around',
    paddingVertical: 10,
    borderTopWidth: 1,
    borderColor: '#ccc',
    backgroundColor: '#fff'
  },
  footerItem: {
    textAlign: 'center',
    fontSize: 12,
    color: '#212529'
  }
});